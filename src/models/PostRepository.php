<?php

namespace Application\Models;

require_once 'src\lib\Database.php';
require_once 'src\models\Post.php';

use Application\Lib\Database;

class PostRepository
{
    private \PDO $connection;

    public function __construct()
    {
        $this->connection = Database::getConnection();
    }

    public function getAll(): array
    {
        try {
            $query = "SELECT * FROM post";
            $statement = $this->connection->prepare($query);
            $statement->execute();
            $posts = [];
            while ($row = $statement->fetch(\PDO::FETCH_ASSOC)) {
                $post = new Post($row['post_id'], $row['title'], $row['content']);
                $posts[] = $post;
            }

            return $posts;
        } catch (\PDOException $e) {
            error_log("Erreur lors de la récupération des billets : " . $e->getMessage(), 3, 'src/logs/error.log');
            throw new \Exception("Erreur lors de la récupération des billets.");
        }
    }
}

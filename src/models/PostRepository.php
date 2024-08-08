<?php

namespace Application\Models;

require_once 'src\lib\Database.php';
require_once 'src\models\Post.php';

use Application\Lib\Database;

class ModelPostRepository
{
    private \PDO $connection;

    public function __construct()
    {
        $this->connection = Database::getConnection();
    }

    public function getAll(): array
    {
        $query = "SELECT * FROM post";
        $statement = $this->connection->prepare($query);
        $statement->execute();
        $posts = [];
        while ($row = $statement->fetch(\PDO::FETCH_ASSOC)) {
            $post = new ModelPost($row['id'], $row['title'], $row['content']);
            $posts[] = $post;
        }

        return $posts;
    }
}
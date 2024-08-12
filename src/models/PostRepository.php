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

    public function createPost($post): bool
    {
        try {
            $query = "INSERT INTO post (title, content, author_id, creation_date) VALUES (:title, :content, :author_id, NOW())";
            $statement = $this->connection->prepare($query);
            return $statement->execute([
                'title' => $post->getTitle(),
                'content' => $post->getContent(),
                'author_id' => $post->getAuthorId(),
            ]);
        } catch (\PDOException $e) {
            error_log("Erreur lors de la création du billet : " . $e->getMessage(), 3, 'src/logs/error.log');
            throw new \Exception("Erreur lors de la création du billet.");
        }
    }

    public function getAllPosts(): array
    {
        try {
            // $query = "SELECT * FROM post";
            $query =
                "SELECT post_id, title, content, post.author_id, email, pseudonym, DATE_FORMAT(creation_date, '%d/%m/%Y') AS french_format_creation_date
                FROM post
                INNER JOIN author
                ON post.author_id = author.author_id
                ORDER BY creation_date DESC";
            $statement = $this->connection->prepare($query);
            $statement->execute();
            $posts = [];
            while ($row = $statement->fetch(\PDO::FETCH_ASSOC)) {
                $post = new Post($row['post_id'], $row['title'], $row['content'], $row['author_id'], $row['email'], $row['pseudonym'], $row['french_format_creation_date']);
                $posts[] = $post;
            }

            return $posts;
        } catch (\PDOException $e) {
            error_log("Erreur lors de la récupération des billets : " . $e->getMessage(), 3, 'src/logs/error.log');
            throw new \Exception("Erreur lors de la récupération des billets.");
        }
    }

    public function getOnePost(int $id): Post
    {
        try {
            // $query = "SELECT * FROM post WHERE post_id = :post_id";
            $query =
                "SELECT post_id, title, content, post.author_id, email, pseudonym, DATE_FORMAT(creation_date, '%d/%m/%Y') AS french_format_creation_date
                FROM post
                INNER JOIN author
                ON post.author_id = author.author_id
                WHERE post_id = :post_id";
            $statement = $this->connection->prepare($query);
            $statement->execute(['post_id' => $id]);

            $row = $statement->fetch(\PDO::FETCH_ASSOC);
            $post = new Post($row['post_id'], $row['title'], $row['content'], $row['author_id'], $row['email'], $row['pseudonym'], $row['french_format_creation_date']);

            return $post;
        } catch (\PDOException $e) {
            error_log("Erreur lors de la récupération d'un billet : " . $e->getMessage(), 3, 'src/logs/error.log');
            throw new \Exception("Erreur lors de la récupération d'un billet.");
        }
    }

    public function updatePost(int $id, string $title, string $content): bool
    {
        try {
            $query = "UPDATE post SET title = :title, content = :content WHERE post_id = :post_id";
            $statement = $this->connection->prepare($query);
            return $statement->execute([
                'title' => $title,
                'content' => $content,
                'post_id' => $id,
            ]);
        } catch (\PDOException $e) {
            error_log("Erreur lors de la mise à jour du billet : " . $e->getMessage(), 3, 'src/logs/error.log');
            throw new \Exception("Erreur lors de la mise à jour du billet.");
        }
    }

    public function deletePost(int $id): bool
    {
        try {
            $query = "DELETE FROM post WHERE post_id = :id";
            $statement = $this->connection->prepare($query);
            return $statement->execute(['id' => $id]);
        } catch (\PDOException $e) {
            error_log("Erreur lors de la suppression du billet : " . $e->getMessage(), 3, 'src/logs/error.log');
            throw new \Exception("Erreur lors de la suppression du billet.");
        }
    }
}

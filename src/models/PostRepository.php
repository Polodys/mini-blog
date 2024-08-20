<?php

namespace Application\Models;

require_once 'src\lib\Database.php';
require_once 'src\models\Post.php';

use Application\Lib\Database;

class PostRepository
{
    private \PDO $connection;

    /**
     * PostRepository class constructor.
     * Initializes the connection to the database.
     */
    public function __construct()
    {
        $this->connection = Database::getConnection();
    }

    /**
     * Inserts a new post in the database
     *
     * @param Post $post The post to insert
     * @return boolean True if successfull insertion, false if not
     * @throws \Exception In case of database error
     */
    public function createPost(Post $post): bool
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
            throw new \Exception("Erreur lors de la création d'un billet.", 0, $e);
        }
    }

    /**
     * Gets all posts from the database
     *
     * @return array An array of Post objects.
     * @throws \Exception In case of database error
     */
    public function getAllPosts(): array
    {
        try {
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
            throw new \Exception("Erreur lors de la récupération des billets.", 0, $e);
        }
    }

    /**
     * Gets a specified post (by its id)
     *
     * @param integer $id The identifier of the post
     * @return Post The specified post
     * @throws \Exception In case of database error
     */
    public function getOnePost(int $id): Post
    {
        try {
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
            throw new \Exception("Erreur lors de la récupération d'un billet.", 0, $e);
        }
    }

    /**
     * Updates a post in the database.
     *
     * @param integer $id The id of the post to update
     * @param string $title The new title of the post
     * @param string $content The new content of the post
     * @return boolean True if update is successfull, false if not
     * @throws \Exception In case of database error
     */
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
            throw new \Exception("Erreur lors de la mise à jour d'un billet.", 0, $e);
        }
    }

    /**
     * Deletes a post from the database
     *
     * @param integer $id The identifier of the post to delete
     * @return boolean True if deletion is successfull, false if not
     */
    public function deletePost(int $id): bool
    {
        try {
            $query = "DELETE FROM post WHERE post_id = :id";
            $statement = $this->connection->prepare($query);
            return $statement->execute(['id' => $id]);
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la récupération d'un billet.", 0, $e);
        }
    }
}

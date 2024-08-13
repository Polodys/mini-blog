<?php

namespace Application\Models;

require_once 'src\lib\Database.php';
require_once 'src\models\Author.php';

use Application\Lib\Database;

class AuthorRepository
{
    private \PDO $connection;

    public function __construct()
    {
        $this->connection = Database::getConnection();
    }

    // Is the email or pseudonym already taken ? (I don't want 2 authors to have the same email or pseudonym)
    public function isEmailOrPseudonymTaken(string $email, string $pseudonym): bool
    {
        try {
            $query = "SELECT COUNT(*) FROM author WHERE email = :email OR pseudonym = :pseudonym";
            $statement = $this->connection->prepare($query);
            $statement->execute(['email' => $email, 'pseudonym' => $pseudonym]);
            return $statement->fetchColumn() > 0; // returns true if the candidate email or pseudonym is already in the 'author' table
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la création d'un auteur.", 0, $e);
        }
    }

    public function createAuthor(string $email, string $pseudonym, string $password): bool
    {
        try {
            if ($this->isEmailOrPseudonymTaken($email, $pseudonym)) {
                return false; // returns false if the candidate email or pseudonym is already in the 'author' table
            }

            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $query = "INSERT INTO author (email, pseudonym, password) VALUES (:email, :pseudonym, :password)";
            $statement = $this->connection->prepare($query);
            return $statement->execute([
                'email' => $email,
                'pseudonym' => $pseudonym,
                'password' => $hashedPassword
            ]);
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la création d'un auteur.", 0, $e);
        }
    }

    public function getAuthorByEmailOrPseudonym(string $identifier): ?Author
    {
        try {
            $query = "SELECT * FROM author WHERE email = :identifier OR pseudonym = :identifier";
            $statement = $this->connection->prepare($query);
            $statement->execute(['identifier' => $identifier]);
            $row = $statement->fetch(\PDO::FETCH_ASSOC);

            if ($row) {
                return new Author($row['author_id'], $row['email'], $row['pseudonym'], $row['password']);
            } else {
                return null;
            }
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la récupération d'un auteur.", 0, $e);
        }
    }
}

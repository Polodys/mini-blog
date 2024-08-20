<?php

namespace Application\Models;

require_once 'src\lib\Database.php';
require_once 'src\models\Author.php';

use Application\Lib\Database;

/**
 * Repository for authors management
 */
class AuthorRepository
{
    private \PDO $connection;

    /**
     * AuthorRepository class constructor.
     * Initializes the connection to the database.
     */
    public function __construct()
    {
        $this->connection = Database::getConnection();
    }

    // Ckecks if the email or pseudonym is already taken (I don't want 2 authors to have the same email or pseudonym)
    
    /**
     * Checks if the email or pseudonym is already taken
     *
     * @param string $email The email adress to check
     * @param string $pseudonym The pseudonym to chekd
     * @return boolean True if the email or the pseudonym is already taken, false if not
     * @throws \Exception In case of database error
     */
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

    /**
     * Creates a new author in the database
     *
     * @param string $email The author's email address
     * @param string $pseudonym The author's pseudonyym
     * @param string $password The author's password (not yet hashed)
     * @return boolean True if creation is a success, false if not
     * @throws \Exception In case of database error
     */
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

    /**
     * Gets an author by his email or his pseudonym.
     *
     * @param string $identifier The email or the pseudonym of the author
     * @return Author|null The corresponding Author object, or null if it doesn't exists
     * @throws \Exception In case of database error
     */
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

<?php

namespace Application\Models;

require_once 'src\lib\Database.php';
require_once 'src\models\User.php';

use Application\Lib\Database;

class UserRepository
{
    private \PDO $connection;

    public function __construct()
    {
        $this->connection = Database::getConnection();
    }

    // Is the email or username already taken ? (I don't want 2 users to have the same email or username)
    public function isEmailOrUsernameTaken(string $email, string $username): bool
    {
        $query = "SELECT COUNT(*) FROM user WHERE email = :email OR username = :username";
        $statement = $this->connection->prepare($query);
        $statement->execute(['email' => $email, 'username' => $username]);
        return $statement->fetchColumn() > 0; // returns true if the candidate email or username is already in the 'user' table
    }

    public function createUser(string $email, string $username, string $password): bool
    {
        try {
            if ($this->isEmailOrUsernameTaken($email, $username)) {
                return false; // returns false if the candidate email or username is already in the 'user' table
            }

            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $query = "INSERT INTO user (email, username, password) VALUES (:email, :username, :password)";
            $statement = $this->connection->prepare($query);
            return $statement->execute([
                'email' => $email,
                'username' => $username,
                'password' => $hashedPassword
            ]);
        } catch (\PDOException $e) {
            error_log("Erreur lors de la création de l'utilisateur : " . $e->getMessage(), 3, 'src/logs/error.log');
            throw new \Exception("Erreur lors de la création de l'utilisateur.");
        }
    }

    public function getUserByEmailOrUsername(string $identifier): ?User
    {
        try {
            $query = "SELECT * FROM user WHERE email = :identifier OR username = :identifier";
            $statement = $this->connection->prepare($query);
            $statement->execute(['identifier' => $identifier]);
            $row = $statement->fetch(\PDO::FETCH_ASSOC);

            if ($row) {
                return new User($row['user_id'], $row['email'], $row['username'], $row['password']);
            }
            return null;
        } catch (\PDOException $e) {
            error_log("Erreur lors de la récupération de l'utilisateur par son email ou son pseudo : " . $e->getMessage(), 3, 'src/logs/error.log');
            throw new \Exception("Erreur lors de la récupération de l'utilisateur.");
        }
    }
}

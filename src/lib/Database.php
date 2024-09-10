<?php

namespace Application\Lib;

use Application\Controllers\ErrorController;

/**
 * Database class
 * Handles the connection to the database with PDO. Uses a singleton to ensure
 * that only one connection is open.
 */
class Database
{
    /**
     * @var \PDO|null PDO connection to the database
     */
    private static ?\PDO $connection = null;

    /**
     * Gets the connection to the database - or sets a connection if none exists
     *
     * @return \PDO Connection to the database
     */
    public static function getConnection(): \PDO
    {
        if (self::$connection === null) {
            // Load database configuration
            $dbConfig = require_once __DIR__ . '/../../config/dbConfig.php';

            try {
                self::$connection = new \PDO(
                    'mysql:host=' . $dbConfig['db_host'] . ';port=' . $dbConfig['db_port'] . ';dbname=' . $dbConfig['db_name'] . ';charset=utf8', 
                    $dbConfig['db_user'],
                    $dbConfig['db_password'],
                    [
                        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
                    ]
                );
            } catch (\PDOException $e) {
                $errorController = new ErrorController();
                $errorController->errorHandler($e);
                exit;
            }
        }

        return self::$connection;
    }
}

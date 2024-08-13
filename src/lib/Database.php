<?php

namespace Application\Lib;

use Application\Controllers\ErrorController;

class Database
{
    private static ?\PDO $connection = null;

    public static function getConnection(): \PDO
    {
        if (self::$connection === null) {
            try {
                self::$connection = new \PDO(
                    'mysql:host=localhost;dbname=blog_ultra_simplifie;charset=utf8',
                    'root',
                    '',
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

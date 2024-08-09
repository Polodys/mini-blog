<?php

namespace Application\Lib;

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
                error_log('Erreur de connexion à la base de données : ' . $e->getMessage(), 3, 'src/logs/error.log');
                throw new \Exception("Impossible de se connecter à la base de données. Veuillez réessayer plus tard.");
            }
        }
    
        return self::$connection;
    }
}

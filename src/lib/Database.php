<?php

namespace Application\Lib;

class Database
{
    private static ?\PDO $connection = null;
    
    public static function getConnection(): \PDO
    {
        if (self::$connection === null) {
            self::$connection = new \PDO('mysql:host=localhost;dbname=blog_ultra_simplifie;charset=utf8', 'root', '');
        }

        return self::$connection;
    }
}
<?php

namespace Root\Www\Model;

use PDO;
use PDOException;

class Database 
{
    private static ?PDO $conn = null;

    private function __construct() {}

    public static function getConnection(): PDO
    {
        if (self::$conn === null) {
            $host = $_ENV['MYSQL_HOST'];
            $dbname = $_ENV['MYSQL_DATABASE'];
            $username = $_ENV['MYSQL_USER'];
            $password = $_ENV['MYSQL_PASSWORD'];

            try {
                self::$conn = new PDO(
                    "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
                    $username,
                    $password,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::ATTR_EMULATE_PREPARES => false,
                    ]
                );
            } catch (PDOException $e) {
                throw new PDOException("Erreur de connexion à la base de données." . $e);
            }
        }

        return self::$conn;
    }
}
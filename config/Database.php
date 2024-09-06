<?php

namespace config;

use PDO;
use PDOException;

class Database
{

    private static string $host = '127.0.0.1';
    private static string $db_name = 'query_builder';
    private static string $username = 'root';
    private static string $password = '';
    private static string $charset = 'utf8mb4';

    public static function connect()
    {
        try {
            return new PDO(
                'mysql:host=' . self::$host . ';dbname=' . self::$db_name . ';charset=' . self::$charset,
                self::$username,
                self::$password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]
            );
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }
}
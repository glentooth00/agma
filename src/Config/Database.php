<?php

namespace App\Config;

use PDO;
use PDOException;

class Database
{
    private static $connection = null;

    public static function connect()
    {
        if (self::$connection === null) {

            $config = require __DIR__ . '/../../config/database.php';
            $default = $config['default'];
            $dbConfig = $config['connections'][$default];

            try {

                // ---------------------------
                // MYSQL via PDO
                // ---------------------------
                if ($dbConfig['driver'] === 'mysql' || $dbConfig['driver'] === 'mysqli') {

                    $dsn = "mysql:host={$dbConfig['host']};dbname={$dbConfig['database']};charset=utf8";

                    self::$connection = new PDO($dsn, $dbConfig['username'], $dbConfig['password'], [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::ATTR_EMULATE_PREPARES => false
                    ]);
                }

                // ---------------------------
                // SQL SERVER via PDO
                // ---------------------------
                elseif ($dbConfig['driver'] === 'sqlsrv') {

                    $dsn = "sqlsrv:Server={$dbConfig['server']};Database={$dbConfig['database']}";

                    self::$connection = new PDO($dsn, $dbConfig['username'], $dbConfig['password'], [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    ]);
                }

                else {
                    die("Invalid database configuration.");
                }

            } catch (PDOException $e) {
                die("Database connection failed: " . $e->getMessage());
            }
        }

        return self::$connection;
    }
}

// $test = Database::connect();

<?php
// Load database config
$config = require_once 'database.php';
error_reporting(0);
use \PDO;
// Get the default database type
$default = $config['default'];
$dbConfig = $config['connections'][$default];

$pdo = null;

try {
    if ($dbConfig['driver'] === 'mysql' || $dbConfig['driver'] === 'mysqli') {
        // Use PDO for MySQL
        $dsn = "mysql:host={$dbConfig['host']};dbname={$dbConfig['database']};charset=utf8";

        $pdo = new PDO($dsn, $dbConfig['username'], $dbConfig['password'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);

        // echo "Connected to MySQL successfully!";
        
    } elseif ($dbConfig['driver'] === 'sqlsrv') {

        // SQL Server (PDO)
        $dsn = "sqlsrv:Server={$dbConfig['server']};Database={$dbConfig['database']}";

        $pdo = new PDO($dsn, $dbConfig['username'], $dbConfig['password'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);

        // echo "Connected to SQL Server successfully!";
        
    } else {
        exit("Invalid database configuration.");
    }
} catch (PDOException $e) {
    exit("Database connection failed: " . $e->getMessage());
}

// Return PDO instance
return $pdo;

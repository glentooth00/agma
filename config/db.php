<?php
// Load database config
$config = require_once 'database.php';
error_reporting(0);
// Get the default database type
$default = $config['default'];
$dbConfig = $config['connections'][$default];

$pdo = null;

var_dump($dbConfig);


switch($dbConfig['driver']) {

    case 'sqlsrv':

        // SQL Server (PDO)
        $dsn = "sqlsrv:Server={$dbConfig['server']};Database={$dbConfig['database']}";

        $pdo = new PDO($dsn, $dbConfig['username'], $dbConfig['password'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
        break;

    case 'mysql':

          // Use PDO for MySQL
        $dsn = "mysql:host={$dbConfig['host']};dbname={$dbConfig['database']};charset=utf8";

        $pdo = new PDO($dsn, $dbConfig['username'], $dbConfig['password'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);
        break;
    default:

        exit("Invalid database configuration.");

}
// Return PDO instance
return $pdo;



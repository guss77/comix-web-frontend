<?php
// app/db.php
// Library for database initialization and setup

function get_pdo()
{
    $dbConfig = require __DIR__ . '/db_config.php';
    $dbHost = $dbConfig['host'];
    $dbName = $dbConfig['dbname'];
    $dbUser = $dbConfig['user'];
    $dbPass = $dbConfig['password'];

    try {
        $pdo = new PDO(
            "mysql:host=$dbHost;dbname=$dbName;charset=utf8mb4",
            $dbUser,
            $dbPass,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
        return $pdo;
    } catch (PDOException $e) {
        http_response_code(500);
        echo "<h1>Database connection failed</h1>";
        echo "<p>" . htmlspecialchars($e->getMessage()) . "</p>";
        exit;
    }
}

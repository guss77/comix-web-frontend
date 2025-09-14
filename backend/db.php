<?php
// app/db.php
// Library for database initialization and setup


class Database {
    private $pdo;

    public function __construct() {
        $dbConfig = require __DIR__ . '/db_config.php';
        $dbHost = $dbConfig['host'];
        $dbName = $dbConfig['dbname'];
        $dbUser = $dbConfig['user'];
        $dbPass = $dbConfig['password'];

        try {
            $this->pdo = new PDO(
                "mysql:host=$dbHost;dbname=$dbName;charset=utf8mb4",
                $dbUser,
                $dbPass,
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
        } catch (PDOException $e) {
            http_response_code(500);
            echo "<h1>Database connection failed</h1>";
            echo "<p>" . htmlspecialchars($e->getMessage()) . "</p>";
            exit;
        }
    }

    // Run a query and fetch all results as objects
    public function fetchAllObjects($query, $params = []) {
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Run a query and fetch all results as a single column
    public function fetchAllColumn($query, $params = [], $column = 0) {
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_COLUMN, $column);
    }

    // Expose raw PDO if needed
    public function getPdo() {
        return $this->pdo;
    }
}

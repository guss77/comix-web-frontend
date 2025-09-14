<?php
// Load environment variables
$dotenv = __DIR__ . '/../.env';
if (file_exists($dotenv)) {
    $lines = file($dotenv, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        list($name, $value) = array_map('trim', explode('=', $line, 2));
        $_ENV[$name] = $value;
    }
}


// Load database configuration from standalone file
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
} catch (PDOException $e) {
    http_response_code(500);
    echo "<h1>Database connection failed</h1>";
    echo "<p>" . htmlspecialchars($e->getMessage()) . "</p>";
    exit;
}

// Example: List comics table
$stmt = $pdo->query('SHOW TABLES');
$tables = $stmt->fetchAll(PDO::FETCH_COLUMN);

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Comix Web Frontend</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Welcome to Comix Web Frontend</h1>
    <p>Connected to database: <strong><?= htmlspecialchars($dbName) ?></strong></p>
    <h2>Tables</h2>
    <ul>
        <?php foreach ($tables as $table): ?>
            <li><?= htmlspecialchars($table) ?></li>
        <?php endforeach; ?>
    </ul>
    <!-- Add your webcomics spider frontend here -->
</body>
</html>

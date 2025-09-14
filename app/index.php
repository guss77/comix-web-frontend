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



require_once __DIR__ . '/db.php';
$pdo = get_pdo();

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
    <h2>Tables</h2>
    <ul>
        <?php foreach ($tables as $table): ?>
            <li><?= htmlspecialchars($table) ?></li>
        <?php endforeach; ?>
    </ul>
    <!-- Add your webcomics spider frontend here -->
</body>
</html>

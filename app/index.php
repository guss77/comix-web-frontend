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
$db = new Database();

// Set JSON header for all responses
header('Content-Type: application/json');

// Get PATH_INFO for routing
$path = $_SERVER['PATH_INFO'] ?? '/';

switch ($path) {
    case '/feeds':
        $feeds = $db->fetchAllObjects('SELECT name, last_update FROM feeds ORDER BY last_update DESC');
        echo json_encode($feeds);
        break;
    case '/':
        // Optionally, provide API root info
        echo json_encode([
            'endpoints' => [
                '/feeds' => 'List all web comic feeds (name, last_update)'
            ]
        ]);
        break;
    default:
        http_response_code(404);
        echo json_encode(['error' => 'Not found']);
        break;
}

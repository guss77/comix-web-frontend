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

// Remove the switch statement, use dispatcher below

// Dispatcher map: [method, pattern, handler]
$routes = [
    // List all feeds
    ['GET', '#^/feeds$#', function() use ($db) {
        $feeds = $db->fetchAllObjects('SELECT * FROM feeds ORDER BY last_update DESC');
        echo json_encode($feeds);
    }],
    // Create a new feed
    ['POST', '#^/feeds$#', function() use ($db) {
        $input = json_decode(file_get_contents('php://input'), true);
        if (!isset($input['name'], $input['homepage'], $input['delay'], $input['active'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Missing required fields: name, homepage, delay, active']);
            return;
        }
        $stmt = $db->getPdo()->prepare('INSERT INTO feeds (name, homepage, delay, active) VALUES (?, ?, ?, ?)');
        $ok = $stmt->execute([
            $input['name'],
            $input['homepage'],
            $input['delay'],
            $input['active']
        ]);
        if ($ok) {
            http_response_code(201);
            echo json_encode(['success' => true, 'id' => $db->getPdo()->lastInsertId()]);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Failed to create feed']);
        }
    }],
    // Delete a feed by id
    ['DELETE', '#^/feed/(\d+)$#', function($matches) use ($db) {
        $id = $matches[1];
        $stmt = $db->getPdo()->prepare('DELETE FROM feeds WHERE id = ?');
        $ok = $stmt->execute([$id]);
        if ($ok && $stmt->rowCount() > 0) {
            echo json_encode(['success' => true]);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Feed not found or not deleted']);
        }
    }],
    // Update a feed by id
    ['PATCH', '#^/feed/(\d+)$#', function($matches) use ($db) {
        $id = $matches[1];
        $input = json_decode(file_get_contents('php://input'), true);
        $fields = ['name', 'homepage', 'delay', 'active'];
        $updates = [];
        $params = [];
        foreach ($fields as $field) {
            if (isset($input[$field])) {
                $updates[] = "$field = ?";
                $params[] = $input[$field];
            }
        }
        if (empty($updates)) {
            http_response_code(400);
            echo json_encode(['error' => 'No updatable fields provided']);
            return;
        }
        $params[] = $id;
        $sql = 'UPDATE feeds SET ' . implode(', ', $updates) . ' WHERE id = ?';
        $stmt = $db->getPdo()->prepare($sql);
        $ok = $stmt->execute($params);
        if ($ok && $stmt->rowCount() > 0) {
            echo json_encode(['success' => true]);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Feed not found or not updated']);
        }
    }],
    // API root info
    ['GET', '#^/$#', function() {
        echo json_encode([
            'endpoints' => [
                '/feeds' => [
                    'GET' => 'List all feeds',
                    'POST' => 'Create feed'
                ],
                '/feed/{id}' => [
                    'DELETE' => 'Delete feed by id',
                    'PATCH' => 'Update feed (name, homepage, delay, active) by id'
                ]
            ]
        ]);
    }],
    // Catch-all for 404
    ['ANY', '#.*#', function() {
        http_response_code(404);
        echo json_encode(['error' => 'Not found']);
    }],
];

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$path = $_SERVER['PATH_INFO'] ?? '/';

foreach ($routes as [$routeMethod, $pattern, $handler]) {
    if (($routeMethod === $method || $routeMethod === 'ANY') && preg_match($pattern, $path, $matches)) {
        // If the pattern has capture groups, $matches will have more than one entry
        if (count($matches) > 1) {
            $handler($matches);
        } else {
            $handler();
        }
        break;
    }
}

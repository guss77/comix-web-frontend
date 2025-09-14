<?php
// Database configuration for Comix Web Frontend
// Loads values from environment variables, with sensible defaults
return [
    'host' => getenv('DB_HOST') ?: 'db',
    'dbname' => getenv('DB_NAME') ?: 'comixdb',
    'user' => getenv('DB_USER') ?: 'comix',
    'password' => getenv('DB_PASSWORD') ?: 'secret',
];

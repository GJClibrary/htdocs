<?php

// Function to parse .env file and set environment variables
function parseEnvFile($filePath) {
    $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if ($lines === false) {
        die("Failed to read the .env file.");
    }
    foreach ($lines as $line) {
        if (strpos($line, '=') !== false && substr($line, 0, 1) !== '#') {
            list($key, $value) = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);
            $_ENV[$key] = $value;
            $_SERVER[$key] = $value;
        }
    }
}

// Load .env file
$dotenvFilePath = __DIR__ . '/.env';
parseEnvFile($dotenvFilePath);

// Check if required environment variables are set
$requiredVariables = ['DB_HOST', 'DB_PORT', 'DB_USERNAME', 'DB_PASSWORD', 'DB_DATABASE'];
foreach ($requiredVariables as $variable) {
    if (!isset($_ENV[$variable])) {
        die("Required environment variable $variable is missing.");
    }
}

// Database credentials
$servername = $_ENV['DB_HOST'] . ':' . $_ENV['DB_PORT'];
$username = $_ENV['DB_USERNAME'];
$password = $_ENV['DB_PASSWORD'];
$database = $_ENV['DB_DATABASE'];

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

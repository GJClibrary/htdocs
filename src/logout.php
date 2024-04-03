<?php
// Get host and URI
$host = $_SERVER['HTTP_HOST'];
$uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$src = '/src';

// Composer dependencies
require_once __DIR__ . '/../vendor/autoload.php';

// Config
require_once __DIR__ . '/../config/config.php';

// Initialize Google Client class
// $config is defined in config.php
$adapter = new Hybridauth\Provider\Google($config);

try {
    if ($adapter->isConnected()) {
        $adapter->disconnect();
        echo 'Logged out the user';
        // Corrected the href attribute to use double quotes for proper interpolation
        echo '<p><a href="http://' . $host . $uri . '/signin.php">Back to login</a></p>';
    }
} catch (Exception $e) {
    echo $e->getMessage();
}

<?php

// Start session for CSRF and flash messages
session_start();

// Define base paths
define('BASE_PATH', dirname(__DIR__));
define('PUBLIC_PATH', __DIR__);
// define('SITE', dirname(__DIR__));
define('SITE', 'giskids.test');

// Load environment variables
if (file_exists(BASE_PATH . '/.env')) {
    $env = parse_ini_file(BASE_PATH . '/.env');
    foreach ($env as $key => $value) {
        $_ENV[$key] = $value;
        putenv("$key=$value");
    }
}

// Load helper functions
require_once BASE_PATH . '/library/helpers.php';

// Load AuthSystem
require_once BASE_PATH . '/library/AuthSystem.php';

// AuthSystem auto-initializes when first used

// Load routing components
require_once BASE_PATH . '/library/Request.php';
require_once BASE_PATH . '/library/Router.php';

// Route the request
Router::route(new Request());
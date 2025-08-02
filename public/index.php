<?php

// Start session for CSRF and flash messages
session_start();

// Define base paths
define('BASE_PATH', dirname(__DIR__));
define('PUBLIC_PATH', __DIR__);
define('SITE1', dirname(__DIR__)); // ~/Sites/giskids
define('SITE2', 'giskids.php');    

// print("SITE1: " . SITE1); echo "<br>";
// print("SITE2: " . SITE2); echo "<br>";
// print("BASE_PATH: " . BASE_PATH); echo "<br>";
// print("PUBLIC_PATH: " . PUBLIC_PATH); echo "<br>";

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
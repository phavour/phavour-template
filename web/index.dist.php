<?php
// Define the application environment (if not already declared)
define('APPLICATION_ENV', 'development'); // or 'production' or 'test'

// Include your Autoload file
include '../vendor/autoload.php';

// Declare the path to your project folder
$dir = realpath(dirname(__FILE__) . '/../');

// Initialise the application
$app = new \Phavour\Application($dir);

// Provide a cache adapter (not required)
// @see \Phavour\Cache\AdapterNull
// @see \Phavour\Cache\AdapterMemcache
// @see \Phavour\Cache\AdapterApc
// @see \Phavour\Cache\AdapterFileSystem
$cache = new \Phavour\Cache\AdapterNull();

// Pass the cache adapter to the application
$app->setCacheAdapter($cache);

// Set the application up
$app->setup();

// Run the application
$app->run();

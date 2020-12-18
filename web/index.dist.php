<?php
// Define the application environment (if not already declared)
define('APPLICATION_ENV', 'development'); // or 'production' or 'test'

// Include the composer autoload file (production etc)
/** @var \Composer\Autoload\ClassLoader $loader */
$loader = include '../vendor/autoload.php';
// Use APC to cache the autoloader for better performance
//$apcLoader = new \Phavour\Autoload\ApcClassLoader('phavour', $loader);
//$loader->unregister();
//$apcLoader->register(true);

// Include the development autoload file (dev etc)
///** @var $loaders \Composer\Autoload\ClassLoader[] */
//$loaders = include '../autoload.php';
// Use APC to cache the autoloader for better performance
//for ($i = 0; $i < count($loaders); $i++)
//{
//    $apcLoader = new \Phavour\Autoload\ApcClassLoader('phavour_' . $i, $loader);
//    $loader->unregister();
//    $apcLoader->register(true);
//}

// Declare the path to your project folder
$dir = realpath(dirname(__FILE__) . '/../');

// Initialise the application
$app = new \Phavour\Application(
    $dir,
    array(
        new Phavour\PhavourTemplate\DefaultPackage\Package(),
        new Phavour\PhavourTemplate\DocsPackage\Package()
    )
);

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

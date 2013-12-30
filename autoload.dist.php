<?php

//
// This is only used in development environments to override
// the composer dependencies to use different versions during
// development. We can then develop on repositories outside of
// the ./vendor directory
//

// Require the composer autoload first so our autoloader will
// take priority.
require_once __DIR__ . '/vendor/autoload.php';

// Require the composer autoloader class because we
// don't want to reinvent the wheel.
require_once __DIR__ . '/vendor/composer/ClassLoader.php';

$loader = new \Composer\Autoload\ClassLoader();

// Namespace map
$map = array(
    //'Phavour' => array(__DIR__ . '/../phavour')
    // Set this to your local Phavour git repository path
);

// Class map
$classMap = array(
);

// Configure the loader
foreach ($map as $namespace => $path) {
    $loader->set($namespace, $path);
}

if ($classMap) {
    $loader->addClassMap($classMap);
}

// Tell the autoloader to register itself.
$loader->register(true);

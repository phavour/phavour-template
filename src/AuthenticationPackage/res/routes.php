<?php
return array(
    'Authentication.index' => array(
        'method' => 'GET',
        'path' => '/auth',
        'runnable' => 'Authentication::index',
        'view.layout' => 'default'
    ),
    'Authentication.login' => array(
        'method' => 'GET|POST',
        'path' => '/auth/login',
        'runnable' => 'Authentication::login',
        'view.layout' => 'default'
    ),
    'Authentication.loggedin' => array(
        'method' => 'GET',
        'path' => '/auth/loggedin',
        'runnable' => 'Authentication::loggedin',
        'view.layout' => 'default'
    ),
    'Authentication.logout' => array(
        'method' => 'GET',
        'path' => '/auth/logout',
        'runnable' => 'Authentication::logout',
        'view.layout' => 'default'
    )
);
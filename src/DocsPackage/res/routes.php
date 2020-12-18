<?php
// Package config keys must start with the package name (without 'Package')
return array(
    'docs.index' => array(
        'method' => 'GET',
        'path' => '/docs',
        'runnable' => 'Index::index',
        'view.directRender' => true,
        'view.layout' => 'default',
        'allow' => array(
            'from' => '',
            'roles' => ''
        )
    ),
    'docs.license' => array(
        'method' => 'GET',
        'path' => '/docs/license',
        'runnable' => 'Index::license',
        'view.directRender' => true,
        'view.layout' => 'default',
        'allow' => array(
            'from' => '',
            'roles' => ''
        )
    ),
    'docs.quickStart' => array(
        'method' => 'GET',
        'path' => '/docs/quick-start',
        'runnable' => 'Index::quickStart',
        'view.directRender' => true,
        'view.layout' => 'default',
        'allow' => array(
            'from' => '',
            'roles' => ''
        )
    ),
    'docs.helloPhavour' => array(
        'method' => 'GET',
        'path' => '/docs/hello-phavour',
        'runnable' => 'Index::helloPhavour',
        'view.directRender' => true,
        'view.layout' => 'default',
        'allow' => array(
            'from' => '',
            'roles' => ''
        )
    ),
    'docs.components.component' => array(
        'method' => 'GET',
        'path' => '/docs/components/{name}',
        'runnable' => 'Components::componentName',
        'allow' => array(
            'from' => '',
            'roles' => ''
        )
    ),
    'docs.auth' => array(
        'method' => 'GET',
        'path' => '/docs/auth',
        'runnable' => 'Auth::authDocs',
        'allow' => array(
            'from' => '',
            'roles' => ''
        )
    )
);
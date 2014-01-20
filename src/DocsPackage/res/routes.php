<?php
// Package config keys must start with the package name (without 'Package')
return array(
    'docs.index' => array(
        'method' => 'GET',
        'path' => '/docs',
        'runnable' => 'Index::index',
        'allow' => array(
            'from' => '',
            'roles' => ''
        )
    ),
    'docs.quickStart' => array(
        'method' => 'GET',
        'path' => '/docs/quick-start',
        'runnable' => 'Index::quickStart',
        'allow' => array(
            'from' => '',
            'roles' => ''
        )
    ),
    'docs.helloPhavour' => array(
        'method' => 'GET',
        'path' => '/docs/hello-phavour',
        'runnable' => 'Index::helloPhavour',
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
    )
);
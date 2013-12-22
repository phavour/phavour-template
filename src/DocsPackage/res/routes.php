<?php
// Package config keys must start with the package name (without 'Package')
return array(
    'docs.index' => array(
        'method' => 'GET',
        'path' => '/docs',
        'runnable' => 'Index::index',
    ),
    'docs.quickStart' => array(
        'method' => 'GET',
        'path' => '/docs/quick-start',
        'runnable' => 'Index::quickStart',
    ),
    'docs.components.bootingPhavour' => array(
        'method' => 'GET',
        'path' => '/docs/components/booting-phavour',
        'runnable' => 'Components::bootingPhavour',
    ),
    'docs.components.phavourRequest' => array(
        'method' => 'GET',
        'path' => '/docs/components/phavour-request',
        'runnable' => 'Components::phavourRequest',
    )
);
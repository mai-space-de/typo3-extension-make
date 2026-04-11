<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Mai Make',
    'description' => 'Extended TYPO3 make/kickstarter CLI tool with make commands for controllers, events, exceptions, migrations, traits, viewhelpers, services, middlewares and upgrade wizards',
    'category' => 'module',
    'author' => 'Maispace',
    'author_email' => '',
    'author_company' => 'Maispace',
    'state' => 'stable',
    'clearCacheOnLoad' => true,
    'version' => '1.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '13.4.0-14.99.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
    'autoload' => [
        'psr-4' => [
            'Maispace\\MaiMake\\' => 'Classes/',
        ],
    ],
];

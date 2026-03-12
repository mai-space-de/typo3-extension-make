<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Make',
    'description' => 'Extended TYPO3 make/kickstarter CLI tool with make commands for controllers, events, exceptions, migrations, traits, viewhelpers, services, middlewares and upgrade wizards',
    'category' => 'misc',
    'author' => 'Maispace',
    'author_email' => '',
    'author_company' => 'Maispace',
    'state' => 'beta',
    'clearCacheOnLoad' => true,
    'version' => '1.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '13.4.0-13.4.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
    'autoload' => [
        'psr-4' => [
            'Maispace\\Make\\' => 'Classes/',
        ],
    ],
];

<?php
$EM_CONF[$_EXTKEY] = [
    'title' => 'Mai Make',
    'description' => 'Extended TYPO3 make/kickstarter CLI tool. Adds `make:*` commands for rapid scaffolding. Bundles `helhum/typo3-console` for enhanced CLI capabilities and `cms-t3editor` for in-backend code editing. Development-only — should not be installed in production.',
    'category' => 'module',
    'author' => 'Maispace',
    'author_email' => '',
    'state' => 'beta',
    'version' => '1.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '13.4.0-14.99.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];

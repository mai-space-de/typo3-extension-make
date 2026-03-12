<?php

declare(strict_types = 1);

// Minimal test bootstrap
$autoload = require __DIR__ . '/../vendor/autoload.php';

// Register test namespace
$autoload->addPsr4('Maispace\\Make\\Tests\\', __DIR__);

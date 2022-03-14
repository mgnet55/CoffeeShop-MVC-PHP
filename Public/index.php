<?php

use Dotenv\Dotenv;

require_once __DIR__ . DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Support'.DIRECTORY_SEPARATOR.'helpers.php';
require_once BASE_PATH . 'vendor'.DIRECTORY_SEPARATOR.'autoload.php';
require_once BASE_PATH . 'routes'.DIRECTORY_SEPARATOR.'web.php';
require_once BASE_PATH . 'routes'.DIRECTORY_SEPARATOR.'admin.php';

$env = Dotenv::createImmutable(BASE_PATH);
$env->load();
app()->run();

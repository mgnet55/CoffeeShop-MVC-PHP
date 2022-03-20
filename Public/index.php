<?php

use Dotenv\Dotenv;

ini_set('session.auto_start', 1);
error_reporting(E_ALL ^ E_WARNING);

require_once __DIR__ . DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Support'.DIRECTORY_SEPARATOR.'Helpers.php';
require_once BASE_PATH . 'vendor'.DS.'autoload.php';
require_once BASE_PATH . 'routes'.DS.'web.php';
require_once BASE_PATH . 'routes'.DS.'admin.php';

$env = Dotenv::createImmutable(BASE_PATH);

$env->load();
app()->run();

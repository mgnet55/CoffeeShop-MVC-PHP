<?php

use App\Models\User;
use Dotenv\Dotenv;
use PhpMvc\Validation\Validator;

require_once __DIR__ . DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Support'.DIRECTORY_SEPARATOR.'helpers.php';
require_once BASE_PATH . 'vendor'.DIRECTORY_SEPARATOR.'autoload.php';
require_once BASE_PATH . 'routes'.DIRECTORY_SEPARATOR.'web.php';
require_once BASE_PATH . 'routes'.DIRECTORY_SEPARATOR.'admin.php';
$env = Dotenv::createImmutable(BASE_PATH);
$env->load();
app()->run();

//$validator = new Validator;
//$validator->setRules(
//    [
//        'username' => 'required|alphanumeric|minlength:8',
//        'email' => 'required|email'
//    ]
//);

//$validator->setAlias('username','USERNAME');
//$validator->validate(
//    [
//        'username' => 'ggffgg',
//        'email' => '',
//    ]
//);

//User::update(2,['phone'=>'update','email'=>'update']);
//var_dump(User::where(1,['id=',1]));

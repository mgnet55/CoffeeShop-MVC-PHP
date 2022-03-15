<?php

use JetBrains\PhpStorm\Pure;
use PhpMvc\Application;
use PhpMvc\Http\Request;
use PhpMvc\Http\Response;
use PhpMvc\Support\Hash;
use PhpMvc\View\View;

const DS = DIRECTORY_SEPARATOR;
define("BASE_PATH", dirname(__DIR__) . DS . '..' . DS);
const VIEWS_PATH = BASE_PATH . 'views' . DS;
const CONFIG_PATH = BASE_PATH . 'config' . DS;
const LAYOUTS_PATH = BASE_PATH . 'views' . DS . 'layouts' . DS;
const UPLOAD_PATH = BASE_PATH.'Public'.DS. 'uploads' . DS;
const PRODUCT_PATH = BASE_PATH . 'assets' . DS . 'product' . DS;

if (!function_exists('config')) {
    function config($key = null, $value = null)
    {
        // no key sent -> return full config dump
        if (is_null($key)) {
            return app()->config;
        }
        //key sent is associative -> set as key=value
        if (is_array($key)) {
            return app()->config->offsetSet(array_keys($key), array_values($key));
        }
        //sent key string with value -> set it
        if (!is_null($value)) {
            return app()->config->offsetSet($key, $value);
        }
        //sent key string without value -> return its value
        return app()->config->offsetGet($key);
    }
}

if (!function_exists('env')) {
    function env($key, $default = null)
    {
        return $_ENV[$key] ?? value($default);
    }
}

if (!function_exists('value')) {
    function value($value)
    {
        return ($value instanceof Closure ? $value() : $value);
    }
}

if (!function_exists('view')) {
    function view($view, $layout = null, $params = [])
    {
        View::make($view, $layout, $params);
    }
}

if (!function_exists('app')) {
    function app(): Application
    {
        static $instance = null;

        if (!$instance) {
            $instance = new Application;
        }
        return $instance;
    }
}

if (!function_exists('bcrypt')) {
    function bcrypt($password): string
    {
        return Hash::password($password);
    }
}

if (!function_exists('classBaseName')) {
    function classBaseName($class)
    {
        if (!$class) {
            return null;
        }
        $class = is_object($class) ? get_class($class) : $class;
        preg_match('/[^\\\/]+$/', $class, $match);
        return $match;
    }
}

if (!function_exists('request')) {
    function request($key = null)
    {
        $instance = new Request;
        if (!$instance) {
            return new Request();
        }
        if ($key) {
            if (is_string($key)) {
                return $instance->get($key);
            }
            if (is_array($key)) {
                return $instance->only($key);
            }
        }
        return $instance;
    }
}

if (!function_exists('userType')) {
    function userType()
    {
        if (empty($_SESSION) || !$_SESSION['type']) {
            return null;
        }
        return $_SESSION['type'];
    }
}

if (!function_exists('isUser')){
    #[Pure] function isUser():bool{
        return userType() === 'user';
    }
}
if (!function_exists('isAdmin')) {
    #[Pure] function isAdmin(): bool
    {
        return userType() === 'admin';
    }
}

//errors handlers and values
if (!function_exists('getErrorMsg')) {
    function getErrorMsg($fieldName)
    {
        if (app()->session->hasFlash('errors')) {
            return app()->session->getFlash('errors')[$fieldName][0] ?? '';
        }
    }
}

if (!function_exists('old')) {
    function old($fieldName)
    {
        if (app()->session->hasFlash('old')) {
            return app()->session->getFlash('old')[$fieldName];
        }
    }
}

if (!function_exists('back')) {
    function back()
    {
        return (new Response())->back();
    }
}
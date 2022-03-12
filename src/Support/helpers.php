<?php

use PhpMvc\Application;
use PhpMvc\Http\Request;
use PhpMvc\Http\Response;
use PhpMvc\Support\Hash;
use PhpMvc\View\View;

define("BASE_PATH", dirname(__DIR__) . '/../');
const VIEWS_PATH = BASE_PATH . 'views/';
const CONFIG_PATH = BASE_PATH . 'config/';
const LAYOUTS_PATH = BASE_PATH.'views/layouts/';

if (!function_exists('config')){
    function config($key=null,$value=null){
        // no key sent -> return full config dump
        if(is_null($key)){
            return app()->config;
        }
        //key sent is associative -> set as key=value
        if (is_array($key)){
            return app()->config->offsetSet(array_keys($key),array_values($key));
        }
        //sent key string with value -> set it
        if(!is_null($value)){
           return app()->config->offsetSet($key,$value);
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
    function view($view,$layout=null, $params = [])
    {
        View::make($view,$layout, $params);
    }
}

if (!function_exists('app')) {
    function app():Application
    {
        static $instance = null;

        if (!$instance) {
            $instance = new Application;
        }
        return $instance;
    }
}

if (!function_exists('bcrypt')){
    function bcrypt($password): string{
        return Hash::password($password);
    }
}

if (!function_exists('classBaseName')){
    function classBaseName($class){
        if (!$class){return null;}
        $class =  is_object($class) ? get_class($class) :$class;
        preg_match('/[^\\\/]+$/',$class,$match);
        return $match;
    }
}

if (!function_exists('old')) {
    function old($key)
    {
        if (app()->session->hasFlash('old')) {
            return app()->session->getFlash('old')[$key];
        }
    }

    if (!function_exists('request')) {
        function request($key = null)
        {
            $instance = new Request;
            if (!$instance) {return new Request();}
            if ($key) {
                if (is_string($key)) {return $instance->get($key);}
                if (is_array($key)) {
                    return $instance->only($key);
                }
            }
            return $instance;
        }
    }

    if (!function_exists('back')) {
        function back()
        {
            return (new Response())->back();
        }
    }
}
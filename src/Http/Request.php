<?php

namespace PhpMvc\Http;

use PhpMvc\Support\Arr;

class Request
{
    public function method()
    {
        return strtoupper($_SERVER['REQUEST_METHOD']);
    }
    public function path(){
        $path = $_SERVER['REQUEST_URI']?? '/';
        $path = trim($path,'/');
        return str_contains($path,'?') ? explode('?',$path)[0]:$path;
    }

    public function data(){
        if ($this->method() === 'GET') {
            return $_GET;
        }

        if ($this->method() === 'POST') {
            return $_POST;
        }
    }

    public function all()
    {
        return $_REQUEST;
    }

    public function only(array $keys){
        return Arr::get($_REQUEST,$keys);
    }
    public function get($key){
        return Arr::get($this->all(),$key);
    }

}
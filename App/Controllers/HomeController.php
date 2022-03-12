<?php

namespace App\Controllers;

class HomeController
{

    public function index()
    {
        return view('home','main');
    }

    public function test()
    {
        return 'hello world';
    }
}
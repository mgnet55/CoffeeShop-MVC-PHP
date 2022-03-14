<?php

namespace App\Controllers;

class HomeController
{

    public function index()
    {
        if (empty($_SESSION['type'])) {
            header("Location: /login");
            return;
        }
        if ($_SESSION['type'] == 'admin') {

            return view('home', 'main');
        }
        if ($_SESSION['type'] == 'user') {
            return view('home', 'main');
        }

    }

}
<?php

namespace App\Controllers;

use App\Models\Admin;
use App\Models\User;
use PhpMvc\Validation\Validator;

class HomeController
{
    public function index()
    {
        if (!isLogged()) {
            return header('location:/login');
        }

        if (isAdmin()) {
            $ordersCount = app()->db->raw('SELECT count(*) FROM orders')[0]['count(*)'];
            $usersCount = app()->db->raw('SELECT count(*) FROM users')[0]['count(*)'];
            $ordersTotal = app()->db->raw('SELECT sum(total_amount) FROM orders')[0]['sum(total_amount)'];
            $ordersProcessing = app()->db->raw("SELECT count(*) FROM orders WHERE order_status = 'processing'")[0]['count(*)'];

            return view('admin.home', 'admin', ['ordersCount' => $ordersCount, 'ordersTotal' => $ordersTotal, 'usersCount' => $usersCount, 'ordersProcessing' => $ordersProcessing]);

        }
        if (isUser()) {
            (new ProductController)->available();
        }

    }

    public function login(){
        return view('auth.login');
    }
    public function auth()
    {
        $v = new Validator;
        $v->setRules([
                'email' => 'email|required',
                'password' => 'required|minlength:8'
            ]
        );
        $v->setAliases(['email' => 'Email', 'password' => 'Password']);
        $v->validate(request()->all());
        if (!$v->isValid()) {
            app()->session->setFlash('errors', $v->getErrors());
            app()->session->setFlash('old', request()->all());
            header('location:/login');
            return;
        }
        $email = request('email');
        $password = request('password');
        $type = 'user';
        $data = User::where(1, ['email=', $email]);
        if (!$data) {

            $data = Admin::where(1, ['email=', $email]);
            $type = 'admin';
        }

        if ($data && password_verify($password, $data[0]->password)) {
            //data is true and password is correct
            foreach ($data[0] as $property => $value) {
                if ($property == 'password') {
                    continue;
                }
                app()->session->set($property, $value);
            }
            app()->session->set('type', $type);

            return header('Location:/');

        }
        app()->session->setFlash('old', request()->all());
        header('location:/login');
    }

    public function logout()
    {
        session_destroy();
        header('location:/login');
    }


}
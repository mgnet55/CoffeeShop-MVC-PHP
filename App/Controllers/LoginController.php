<?php
namespace App\Controllers;

use App\Models\Admin;
use App\Models\User;
use PhpMvc\Validation\Validator;

class LoginController
{
    public function index()
    {
        return view('auth.login');

    }

    public function login()
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
            header('location:./login');
            return;
        }
        $email = request('email');
        $password =request('password');
        $type = 'user';
        $data = User::where(1, ['email=', $email]);
        if(!$data){

            $data = Admin::where(1, ['email=', $email]);
            $type = 'admin';
        }

        if ($data && password_verify($password,$data[0]->password)) {
            //data is true and password is correct
            foreach ($data[0] as $property => $value) {
                if ($property == 'password'){continue;}
                app()->session->set($property, $value);
            }
            app()->session->set('type', $type);
            header('Location:/home');
            return;
        }
        app()->session->setFlash('old', request()->all());
        header('location:./login');
    }

    public function logout(){
        session_destroy();
        return view('auth.login');
    }
}
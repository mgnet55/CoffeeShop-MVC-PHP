<?php

namespace App\Controllers;

use App\Models\User;
use PhpMvc\Validation\Validator;

class RegisterController
{
    public function index()
    {
        return view('auth.register', 'main');
    }
    public function store()
    {
        $v = new Validator;
        $v->setRules([
            'username'=>"required|alphanumeric|between:2,20",
            'email'=>'email|required'
            ]
        );
        $v->setAlias('password_confirmation','password confirmation');
        $v->validate(request()->all());

        if (!$v->isValid()){
            app()->session->setFlash('$errors',$v->getErrors());
            app()->session->setFlash('old',request()->all());
            return back();
        }

        User::create(
            [
                'email' => request('email'),
                'password' => bcrypt(request('password'))
            ]
        );
       app()->session->setFlash('success','Registered Successfully');
       header('location: ./');
    }


}
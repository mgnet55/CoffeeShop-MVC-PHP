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
            'username'=>"required|alphanumeric",
            'email'=>'email'
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
                'phone'=>'userdfdfname',
                'email'=>'email@yahoo.com'
            ]
        );
       app()->session->setFlash('success','Registered Successfully');
       header('location: ./');
    }


}
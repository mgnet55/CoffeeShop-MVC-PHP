<?php

namespace App\Controllers\old_controllers;

use Exception;
use App\Models\User;
use PhpMvc\Validation\Validator;


class RegisterController
{
    public function index()
    {
        if(!isAdmin())
        {return view('erros.403');}
        return view('auth.register', 'main');
    }


    public function store()
    {
        if(!isAdmin())
        {return view('erros.403');}

        $v = new Validator;
        $v->setRules([
                'username' => "required|alphanumeric|between:8,20",
                'email' => 'email|required',
                'name' => 'required|chars',
                'password' => 'requires|password|confirmed',
            ]
        );
        $v->setAlias('password_confirmation', 'Password confirmation');
        $v->validate(request()->all());

        if (!$v->isValid()) {
            app()->session->setflash('errors', $v->getErrors());
            app()->session->setflash('old', request()->all());
            return back();
        }

        //handle file upload and if wrong don't save , else upload and save it to uploads folder
        //file upload to be implemented in helper functions
        if (empty($_FILES['avatar']['tmp_name'])) {
            return back();
        }

        $file = $_FILES['avatar_file']['tmp_name'];
        $fileType = mime_content_type($file);
        $fileExtension = substr($fileType, 6);
        if (str_contains($fileType, "image")) {
            try {
                move_uploaded_file($file, UPLOAD_PATH . request('username') . '_avatar.' . $fileExtension);
                $dbAvatarName = request('username') . '_avatar.' . $fileExtension;
            } catch (Exception $e) {
                return $e->getMessage();
            }
        } else {
            return back();
        }
        User::create(
            [
                'username' => request('username'),
                'name' => request('name'),
                'email' => request('email'),
                'avatar' => $dbAvatarName,
                'password' => bcrypt(request('password'))
            ]
        );
        app()->session->setFlash('success', 'Registered Successfully');
        return back();
    }

}
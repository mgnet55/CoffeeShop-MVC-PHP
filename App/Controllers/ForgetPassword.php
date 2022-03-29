<?php

namespace App\Controllers;

use App\Models\PasswordReset;
use App\Models\User;
use PhpMvc\Support\MailBuilder;
use PhpMvc\Validation\Validator;

class ForgetPassword
{
    public function forget()
    {
        return view('auth.forget_form');
    }

    public function generate_token()
    {
        $v = new Validator;
        $v->setRules([
                'email' => 'required|email'
            ]
        );
        $v->validate(['email' => request('email')]);
        if (!$v->isValid()) {
            app()->session->setflash('errors', $v->getErrors());
            app()->session->setflash('old', request()->all());
            return back();
        }

        $user = User::where(1, ['email=', request('email')], ['email', 'name'])[0];
        if (!$user) {
            return back();
        }
        $mail = new MailBuilder;
        $reset = PasswordReset::where(1, ['email=', $user->email])[0];
        if ($reset) {
            $mail->sendTo($reset->email, $user->name)->passwordResetMail($reset->reset_token)->send();
            return view('auth.email_sent');
        }
        $token = md5($user->email . $user->name . strtotime('now'));
        PasswordReset::create(['reset_token' => $token, 'email' => $user->email]);
        $mail->sendTo($user->email, $user->name)->passwordResetMail($token)->send();
        return view('auth.email_sent');

    }

    public function reset()
    {
        $token = request('token');
        if (!$token) {
            return view('errors.404');
        }
        $resetInfo = PasswordReset::where(1, ['reset_token=', $token]);
        if (!$resetInfo) {
            return view('errors.404');
        }
        return view('auth.reset_form', params: ['resetInfo' => $resetInfo[0]]);

    }

    public function updatePassword()
    {
        $v = new Validator;
        $v->setRules([
                'reset_token' => 'required|minlength:32|maxlength:32',
                'password' => 'password|password|confirmed'
            ]
        );
        $v->validate(request()->all());
        if (!$v->isValid()) {
            app()->session->setflash('errors', $v->getErrors());
            app()->session->setflash('old', request()->all());
            return back();
        }
        $resetInfo = PasswordReset::where(1, ['reset_token=', request('reset_token')]);
        if (!$resetInfo) {
            return view('errors.404');
        }
        $password = bcrypt(request('password'));
        app()->db->raw('UPDATE users SET `password`=? WHERE `email`=?', [$password, $resetInfo[0]->email]);
        PasswordReset::delete($resetInfo[0]->id);
        return header('Location:/login');
    }


}
<?php

namespace App\Controllers;

use App\Models\PasswordReset;
use App\Models\User;
use PHPMailer\PHPMailer\PHPMailer;
use PhpMvc\Support\Hash;
use PhpMvc\Validation\Validator;

class ForgetPassword
{
    public function index()
    {
        return view('user.reset_password');
    }


    public function generate_token(){
        $v = new Validator;
        $v->setRules([
                'email' => 'required|email'
            ]
        );
        $v->validate(['email'=> request('email')]);
        if (!$v->isValid()) {
            app()->session->setflash('errors', $v->getErrors());
            app()->session->setflash('old', request()->all());
            return back();
        }

        $user = User::where(1,['email=',request('email')],['email','name'])[0];
        if($user){
            $token = md5($user->email.$user->name.strtotime('now'));
            PasswordReset::create(['reset_token'=>$token,'email'=>$user->email]);
            $this->sendMail($user->email,$user->name,$token,);
        }
    }

    public function sendMail($email,$name,$token)
    {

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = env('MAIL_HOST');
        $mail->SMTPAuth = env('MAIL_SMTP_AUTH');
        $mail->Port = env('MAIL_PORT');
        $mail->Username = env('MAIL_USERNAME');
        $mail->Password = env('MAIL_PASSWORD');
        $mail->From = "admin@sweetcoffe.com";
        $mail->FromName = "Sweet Coffee";
        $mail->addAddress($email, $name);
        $mail->isHTML(true);
        $mail->Subject = "Reset Password";
        $mail->Body = "<h2>Hi $name</h2><br><p>you've requseted a reset password here you are</p><br><a href='{$_SERVER["SERVER_NAME"]}/reset?token={$token}'></a>";
        dd($mail);
        try {
            $mail->send();
            echo "Message has been sent successfully";
        } catch (Exception $e) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        }
    }

}
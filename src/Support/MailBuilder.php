<?php

namespace PhpMvc\Support;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class MailBuilder
{
    public PHPMailer $mail;
    public string $name;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);
        $this->mail->isSMTP();
        $this->mail->Host = env('MAIL_HOST');
        $this->mail->SMTPAuth = env('MAIL_SMTP_AUTH');
        $this->mail->Port = env('MAIL_PORT');
        $this->mail->Username = env('MAIL_USERNAME');
        $this->mail->Password = env('MAIL_PASSWORD');
        $this->mail->SMTPSecure = 'tls';
        $this->mail->setFrom("admin@mvc.test", env('APP_NAME'));
        $this->name = 'username';
        return $this;
    }

    public function sendTo($email, $username)
    {
        $this->mail->addAddress($email, $username);
        $this->name = $username;
        return $this;
    }

    public function passwordResetMail($token)
    {
        $this->mail->Subject = "Reset Password";
        $this->mail->isHTML(true);
        $this->mail->Body =
            '<!doctype html>
            <html lang="en-US">
            <head>
                <meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
                <title>Reset Password</title>
                <meta name="description" content="Reset Password Email Template.">
            </head>
            <body marginheight="0" marginwidth="0" style="background-color: #f2f3f8;">
            <table
                <tr>
                    <td>
                        <table style="background-color: #f2f3f8; max-width:670px;  margin:0 auto;">
                            <tr><td style="height:80px;">&nbsp;</td></tr>
                            <tr><td style="text-align:center;"><img width="60" src="//' . $_SERVER["SERVER_NAME"] . '/logo.png" title="logo" alt="logo"></td></tr>
                            <tr><td style="height:20px;">&nbsp;</td></tr>
                            <tr>
                                <td>
                                    <table style="max-width:670px;background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
                                        <tr>
                                            <td style="height:40px;">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td style="padding:0 35px;">
                                                <h1 style="color:#1e1e2d; font-weight:500; margin:0;font-size:32px;font-family:Rubik,sans-serif;">
                                                    Hi ' . $this->name . ',, You have requested to reset your password</h1>
                                                <span style="display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;"></span>
                                                <p style="color:#455056; font-size:15px;line-height:24px; margin:0;">
                                                    We cannot simply send you your old password. A unique link to reset your
                                                    password has been generated for you. To reset your password, click the
                                                    following link and follow the instructions.
                                                </p>
                                                <a href="//' . $_SERVER["SERVER_NAME"] . '/reset?token=' . $token . '"
                                                   style="background:#20e277;text-decoration:none !important; font-weight:500; margin-top:35px; color:#fff;text-transform:uppercase; font-size:14px;padding:10px 24px;display:inline-block;border-radius:50px;">Reset
                                                    Password</a>
                                            </td>
                                        </tr>
                                        <tr><td style="height:40px;">&nbsp;</td></tr>
                                    </table>
                                </td>
                            <tr>
                                <td style="height:20px;">&nbsp;</td>
                            </tr>
                            <tr>
                                <td style="text-align:center;">
                                    <p style="font-size:14px; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;">
                                        &copy; <strong>' . $_SERVER["SERVER_NAME"] . '</strong></p>
                                </td>
                            </tr>
                            <tr>
                                <td style="height:80px;">&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            </body>
            </html>';
        return $this;

    }

    public function passwordChangedMail()
    {
        //Todo sending notification password changed successfully
    }

    public function send()
    {
        try {
            $this->mail->send();
            return true;
        } catch (Exception) {
            return false;
        }
    }

}
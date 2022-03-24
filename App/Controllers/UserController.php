<?php

namespace App\Controllers;

use App\Models\Order;
use App\Models\User;
use PhpMvc\Validation\Validator;

class UserController
{
    public function __call($method, array $args)
    {
        if (isLogged()) {
            if (method_exists($this, $method)) {
                return call_user_func_array([$this, $method], $args);
            } else {
                return view('errors.404');
            }
        }
        return header('location:/login');
    }

    protected function index()
    {
        if (!isAdmin()) {
            return view('errors.403');
        }
        $page = request()->get('page') ?? 1;
        $users = User::all($page);
        return view('admin.users', 'admin', ['users' => $users, 'page' => $page]);
    }

    protected function create()
    {
        if (!isAdmin()) {
            return view('errors.403');
        }
        return view('admin.addUser', 'admin');
    }

    protected function store()
    {
        if (!isAdmin()) {
            return view('errors.403');
        }
        $v = new Validator;
        $v->setRules([
                'email' => 'required|email',
                'name' => 'required|chars|minlength:4',
                'password' => 'required|confirmed',
                'room' => 'required|numeric',
                'ext' => 'required|numeric',
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


        $file = $_FILES['avatar']['tmp_name'];
        $fileType = mime_content_type($file);
        $fileExtension = substr($fileType, 6);
        if (str_contains($fileType, "image")) {
            try {
                $string = str_replace(' ', '-', request('email')); // Replaces all spaces with hyphens.
                $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

                move_uploaded_file($file, UPLOAD_PATH . $string . '_avatar.' . $fileExtension);
                $dbAvatarName = $string . '_avatar.' . $fileExtension;
            } catch (Exception $e) {
                return $e->getMessage();
            }
        } else {
            return back();
        }

        User::create(
            [
                'name' => request('name'),
                'email' => request('email'),
                'avatar' => $dbAvatarName,
                'password' => bcrypt(request('password')),
                'room' => request('room'),
                'ext' => request('ext')
            ]
        );
        //app()->session->setFlash('success', 'Registered Successfully');
        header('Location: /admin/users');
    }

    protected function edit()
    {
        if (!isAdmin()) {
            return view('errors.403');
        }
        $userId = (int)request()->get('id');
        if (!$userId) {
            return view('errors.404');
        }
        $user = User::where('1', ['id=', $userId]);
        if (!$user) {
            return view('errors.404');
        }
        return view('admin.editUser', 'admin', ['user' => $user[0]]);
    }

    protected function update()
    {
        $uid = (int)request('id');

        if (!$uid || !User::where(1, ['id=', $uid])) {
            return view('erros.404');
        }

        $v = new Validator;
        $v->setRules([
                'email' => 'required|email',
                'name' => 'required|chars|minlength:4',
                'password' => 'required|confirmed',
                'room' => 'required|numeric',
                'ext' => 'required|numeric',
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
        $dbAvatarName = '';

        if (!empty($_FILES['avatar']['tmp_name'])) {

            $file = $_FILES['avatar']['tmp_name'];
            $fileType = mime_content_type($file);
            $fileExtension = substr($fileType, 6);
            if (str_contains($fileType, "image")) {
                try {
                    $string = str_replace(' ', '-', request('email')); // Replaces all spaces with hyphens.
                    $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

                    move_uploaded_file($file, UPLOAD_PATH . $string . '_avatar.' . $fileExtension);
                    $dbAvatarName = $string . '_avatar.' . $fileExtension;
                } catch (Exception $e) {
                    return $e->getMessage();
                }
            } else {
                return back();
            }

        }

        $userData = [
            'name' => request('name'),
            'email' => request('email'),
            'avatar' => $dbAvatarName,
            'password' => bcrypt(request('password')),
            'room' => request('room'),
            'ext' => request('ext')
        ];

        if (!$dbAvatarName) {
            unset($userData['avatar']);
        }

        User::update($uid, $userData);
        //app()->session->setFlash('success', 'Registered Successfully');
        header('Location: /admin/users');
    }

    protected function destroy()
    {
        if (!isAdmin()) {
            return view('errors.403');
        }
        $userId = (int)request()->get('id');
        if (!$userId) {
            return view('errors.404');
        }
        User::delete($userId);
        header('Location:/admin/users');
    }

    protected function orders()
    {
        if (isAdmin()) {
            $id = request('id');
            if (!$id) {
                return back();
            }

            $user = User::where(1, ['id=', (int)$id], ['name']);
            $orders = Order::where(1, ['user_id=', $id]);
            return view('admin.user_orders', 'admin', ['orders' => $orders, 'user' => $user[0]->name]);

        } else {
            $userId = $_SESSION['id'];
            $orders = Order::where(pageNumber(), ['user_id=', $userId]);
            return view('user.orders', 'main', ['orders' => $orders]);
        }
    }


}
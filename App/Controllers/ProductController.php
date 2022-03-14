<?php

namespace App\Controllers;

use App\Models\Product;
use JetBrains\PhpStorm\Pure;
use PhpMvc\Validation\Validator;

class ProductController
{
    #[Pure] public function notAuthorized(): bool
    {
        return in_array(userType(), ['user', null], true);
    }

    public function get()
    {
        $id = request('id');
        if (!$id) {
            $this->getAll();
            //TODO:return table view in layout
        }
        $this->getOne($id);
            //TODO:return only one product in layout

    }

    public function store()
    {
        //from post // if not admin return error
        if ($this->notAuthorized()) {
            return view('errors.404');
        }
        $v = new Validator;
        $v->setRules([
                'name' => "required|alphanumeric|min:3",
                'price' => 'number|required',
            ]
        );
        $v->setAlias('password_confirmation', 'password confirmation');
        $v->validate(request()->all());

        if (!$v->isValid()) {
            app()->session->setflash('errors', $v->getErrors());
            app()->session->setflash('old', request()->all());
            return back();
        }
        if (empty($_FILES['avatar']['tmp_name'])) {
            return back();
        }
        $file = $_FILES['avatar_file']['tmp_name'];
        $fileType = mime_content_type($file);
        $fileExtension = substr($fileType, 6);
        if (str_contains($fileType, "image")) {
            try {
                move_uploaded_file($file, PRODUCT_PATH . request('name') . '_image.' . $fileExtension);
                $dbAvatarName = request('name') . '_image.' . $fileExtension;
            } catch (Exception $e) {
                return $e->getMessage();
            }
        } else {
            return back();
        }
        Product::create(
            [
                'name' => request('name'),
                'price' => request('price'),
                'image' => $dbAvatarName,
                'available' => '1'
            ]
        );


    }

    public function update()
    {
        if ($this->notAuthorized()) {
            return view('errors.404');
        }
        //TODO:get data ,verify and save

    }

    public function getAvaialable()
    {
        //return products availabe only

    }

    public function delete()
    {

    }

    public function getOne($id)
    {

    }

    public function getAll()
    {

    }

}
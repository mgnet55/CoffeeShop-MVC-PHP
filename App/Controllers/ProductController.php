<?php

namespace App\Controllers;

use App\Models\Category;
use App\Models\Product;
use PhpMvc\Validation\Validator;

class ProductController
{
    public function __call($method, array $args)
    {
        if (method_exists($this, $method)) {
            if (isLogged()) {
                return call_user_func_array([$this, $method], $args);
            } else {
                return header('location:/login');
            }
        } else {
            return view('errors.404');
        }
    }

    protected function create()
    {
        if (!isAdmin()) {
            return view('errors.403');
        }
        $categories = Category::all(1);
        return view('admin.addProduct', 'admin', ['categories' => $categories]);

    }

    protected function store()
    {
        if (!isAdmin()) {
            return view('errors.403');
        }

        $v = new Validator;
        $v->setRules([
                'prd_name' => 'required',
                'price' => 'required',
                'cat_id' => 'required',
            ]
        );
        //handle file upload and if wrong don't save , else upload and save it to uploads folder
        //file upload to be implemented in helper functions
        if (empty($_FILES['image']['tmp_name'])) {
            return back();
        }
        $file = $_FILES['image']['tmp_name'];
        $fileType = mime_content_type($file);
        $fileExtension = substr($fileType, 6);
        if (str_contains($fileType, "image")) {
            try {
                $string = str_replace(' ', '-', request('prd_name')); // Replaces all spaces with hyphens.
                $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

                move_uploaded_file($file, UPLOAD_PATH . $string . '_image.' . $fileExtension);
                $dbImageName = $string . '_image.' . $fileExtension;
            } catch (Exception $e) {
                return $e->getMessage();
            }
        } else {
            return back();
        }
        Product::create(
            [
                'prd_name' => request('prd_name'),
                'price' => request('price'),
                'cat_id' => request('cat_id'),
                'image' => $dbImageName
            ]
        );
        //app()->session->setFlash('success', 'Registered Successfully');
        header('Location: /admin/products');
    }

    protected function edit()
    {
        if (!isAdmin()) {
            return view('errors.403');
        }

        $productId = (int)request()->get('id');
        if (!$productId) {
            return view('errors.404');
        }
        $product = Product::where('1', ['id=', $productId]);
        if (!$product) {
            return view('errors.404');
        }
        return view('admin.editProduct', 'admin', ['product' => $product[0]]);
    }

    protected function destroy()
    {
        if (!isAdmin()) {
            return view('errors.403');
        }

        $productId = (int)request()->get('id');
        if (!$productId) {
            return view('errors.404');
        }
        Product::delete($productId);
        header('location:/admin/products');
    }

    protected function index()
    {
        if (!isAdmin()) {
            return view('errors.403');
        }

        $page = (int)request()->get('page');
        if (!$page) {
            $page = 1;
        }
        $products = Product::all($page);
        return view('admin.products', 'admin', ['products' => $products]);
    }

    protected function update()
    {
        if (!isAdmin()) {
            return view('errors.403');
        }

        $pid = (int)request('id');

        if (!$pid || !Product::where(1, ['id=', $pid])) {
            return view('erros.404');
        }

        $v = new Validator;
        $v->setRules([
                'prd_name' => 'required',
                'price' => 'required',
                'cat_id' => 'required',
            ]

        );
        //handle file upload and if wrong don't save , else upload and save it to uploads folder
        //file upload to be implemented in helper functions
        $dbImageName = '';
        if (!empty($_FILES['image']['tmp_name'])) {
            $file = $_FILES['image']['tmp_name'];
            $fileType = mime_content_type($file);
            $fileExtension = substr($fileType, 6);
            if (str_contains($fileType, "image")) {
                try {
                    $string = str_replace(' ', '-', request('prd_name')); // Replaces all spaces with hyphens.
                    $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.

                    move_uploaded_file($file, UPLOAD_PATH . $string . '_image.' . $fileExtension);
                    $dbImageName = $string . '_image.' . $fileExtension;
                } catch (Exception $e) {
                    return $e->getMessage();
                }
            } else {
                return back();
            }
        }
        $productData = [
            'prd_name' => request('prd_name'),
            'price' => request('price'),
            'cat_id' => request('cat_id'),
            'image' => $dbImageName
        ];
        if (!$dbImageName) {
            unset($productData['image']);
        }
        Product::update($pid, $productData);
        //app()->session->setFlash('success', 'Registered Successfully');
        header('Location: /admin/products');
    }

    public function available(){
        if(isAdmin()){
            return header('Location:/admin');
        }
        $products = Product::where(pageNumber(), ['available=', 1]);
        return view('user.home', 'main', ['products' => $products]);
    }

}
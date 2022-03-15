<?php

namespace App\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;

use Exception;

use PhpMvc\Validation\Validator;

class AdminController
{
    public function index()
    {
        if (isAdmin()) {
            header('Location:/admin/users');
        }

        return View('errors.403');

    }
 



    //TODO  USER functions===============================================
    //add user Get returns form // POST checks and save
    //delete user GET
    //get all users
    //edit user GET returns user form // POST checks and save
    public function getAddUser()
    {
        if (isAdmin()) {
            // $page = request()->get('page') ?? 1;
            // $users = User::all($page);
            return view('admin.addUser', 'admin');
        }
        return view('errors.403');
    }

    public function store()
    {       
        dump($_FILES);exit;
        if(!isAdmin())
        {return view('erros.403');}

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
        app()->session->setFlash('success', 'Registered Successfully');
        return back();
    }


    public function postAddUser()
    {

    }

    public function getEditUser()
    {

    }

    public function postEditUser()
    {

    }

    public function deleteUser()
    {
    }

    public function allUsers()
    {
        if (isAdmin()) {
            $page = request()->get('page') ?? 1;
            $users = User::all($page);
            return view('admin.users', 'admin', ['users' => $users,'page'=>$page]);
        }
        return view('errors.403');
    }




    //product function
    //TODO  PRODUCTS functions===============================================
    //add product GET returns form // POST checks and save product
    //delete product GET id
    //get all products
    //get product
    //edit product GET / POST
    
    public function GetaddProduct()
    {
        if (isAdmin()) {
            // $page = request()->get('page') ?? 1;
            // $users = User::all($page);
            return view('admin.addProduct', 'admin');
        }
        return view('errors.403');
    }

    public function postAddProduct()
    {

    }

    public function getEditProduct()
    {

    }

    public function postEditProduct()
    {

    }

    //
    public function deleteProduct()
    {
    }

    public function allProducts()
    {
        if (isAdmin()) {
            $page = request()->get('page') ?? 1;
            $products = Product::all($page);
            return view('admin.products', 'admin', ['products' => $products]);
        }
        return view('errors.403');
    }




    //order functions
    //TODO  ORDERS functions===============================================
    //add order for user {returns all products and users}
    //delete order GET id
    //get pending orders GET
    //get all orders GET
    //edit product GET / POST

    public function allOrders()
    {
        if (isAdmin()) {
            $page = request()->get('page') ?? 1; //used to paginate query to improve performance as usual
            $orders = app()->db->raw('SELECT orders.id,order_date,order_status,total_amount,name FROM orders,users WHERE orders.user_id = users.id');
            return view('admin.orders', 'admin', ['orders' => $orders]);
        }
        return view('errors.403');
    }

    public function manualOrders(){
        if (isAdmin()) {
            // $page = request()->get('page') ?? 1;
            // $users = User::all($page);
            return view('admin.manual_orders', 'admin');
        }
        return view('errors.403');
    }


}
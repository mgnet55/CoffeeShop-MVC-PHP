<?php

namespace App\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class AdminController
{
    public function index()
    {
        if (isAdmin()) {
            header('Location:/admin/users');
        }

        return View('errors.403');

    }
    //TODO  PRODUCTS functions===============================================
    //add product GET returns form // POST checks and save product
    //delete product GET id
    //get all products
    //get product
    //edit product GET / POST

    //TODO  ORDERS functions===============================================
    //add order for user {returns all products and users}
    //delete order GET id
    //get pending orders GET
    //get all orders GET
    //edit product GET / POST

    //TODO  USER functions===============================================
    //add user Get returns form // POST checks and save
    //delete user GET
    //get all users
    //edit user GET returns user form // POST checks and save
    public function getAddUser()
    {

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
    public function GetaddProduct()
    {

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
    public function allOrders()
    {
        if (isAdmin()) {
            $page = request()->get('page') ?? 1; //used to paginate query to improve performance as usual
            $orders = app()->db->raw('SELECT orders.id,order_date,order_status,total_amount,name FROM orders,users WHERE orders.user_id = users.id');
            return view('admin.orders', 'admin', ['orders' => $orders]);
        }
        return view('errors.403');
    }

}
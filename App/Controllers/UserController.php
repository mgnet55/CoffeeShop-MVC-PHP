<?php

namespace App\Controllers;

use App\Models\Order;
use App\Models\Product;

class UserController
{
    public function __construct()
    {
        if (!$_SESSION['type']) {
            return header('location:/login');
        }
        if ($_SESSION['type'] == 'admin') {
            return header('Location:/admin');
        }
    }
    public function pageNumber(){
        $page = (int)request()->get('page');
        if (!$page) {
            $page = 1;
        }
        return $page;
    }

    public function allproducts()
    {
        $page = $this->pageNumber();
        $products = Product::where($page,['available=',1]);
        return view('user.products', 'main', ['products' => $products]);
    }

    public function postAddOrder()
    {
        //$userId = (int)$_SESSION['id'];
//        $products =[1=>20,3=>2];
//        $totalPrice[];
//        foreach($proucts as $product_i

//        }
        $orderId = (int)(Order::create(['user_id' => 3, 'total_amount' => 500]));
        //for loop on every product an add it to the order_products table with order id

    }

    public function getUserProducts()
    {
        $userId = $_SESSION['id'];
        $page = $this->pageNumber();
        $orders = Order::where($page,['user_id=',$userId]);
        return view('user.orders','main',['orders'=>$orders]);
    }
}
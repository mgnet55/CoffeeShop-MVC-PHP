<?php

namespace App\Controllers;

use App\Models\Order;
use App\Models\OrderProducts;
use App\Models\Product;
use Exception;

class UserController
{

    public function __construct()
    {
        if (!$_SESSION['type']) {
            return header('location:/login');
        }
        if (isAdmin()) {
            return header('Location:/admin');
        }
    }

    public function pageNumber()
    {
        $page = (int)request()->get('page');
        if (!$page) {
            $page = 1;
        }
        return $page;
    }

    public function allproducts()
    {

        $page = $this->pageNumber();
        $products = Product::where($page, ['available=', 1]);
        return view('user.home', 'main', ['products' => $products]);
    }

    public function postAddOrder()
    {
        header('Content-Type: text/html');

        try {
            $orderProducts = json_decode(file_get_contents('php://input'), true);
            //building values holders for PDO binding
            $holders = '(';
            for ($i = 0, $imax = count($orderProducts); $i < $imax; $i++) {
                $holders .= '?,';
            }
            $holders = rtrim($holders, ',') . ')';
            //SQL statement
            $stmt = 'SELECT id,price FROM products WHERE id IN' . $holders;
            $dbProducts = app()->db->raw($stmt, array_keys($orderProducts));
            $orderId = Order::create(['user_id' => (int)$_SESSION['id'], 'total_amount' => 0]);
            // calculating total price and inserting products
            $totalPrice = 0;
            foreach ($dbProducts as $dbProduct) {
                $totalPrice += $dbProduct['price'] * $orderProducts[$dbProduct['id']];
                OrderProducts::create(['order_id' => $orderId, 'product_id' => (int)$dbProduct['id'], 'quantity' => (int)$orderProducts[$dbProduct['id']]]);
            }
            //Update Total or revert
            if ($totalPrice == 0) {
                Order::delete($orderId);
            } else
                Order::update($orderId, ['total_amount' => $totalPrice],);
            echo json_encode(['success' => true]);
        } catch (Exception $e) {
            echo json_encode(['success' => false]);
        }
    }

    public function getUserOrders()
    {
        $userId = $_SESSION['id'];
        $page = $this->pageNumber();
        $orders = Order::where($page, ['user_id=', $userId]);
        return view('user.orders', 'main', ['orders' => $orders]);
    }

    public function orderDetails()
    {
        $orderId = request('id');
        $product = app()->db->raw('SELECT prd_name,quantity,image FROM products,order_products,orders WHERE orders.user_id = ? AND products.id = order_products.product_id AND order_products.order_id=? GROUP BY products.id', [$_SESSION['id'], $orderId]);
        header('Content-Type: application/json');
        echo json_encode($product);
    }
}
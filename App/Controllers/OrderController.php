<?php

namespace App\Controllers;

use App\Models\Order;
use App\Models\OrderProducts;

class OrderController
{
    public function __call($method, array $args)
    {
        if (method_exists($this, $method)) {
            if (isLogged()) {
                return call_user_func_array([$this, $method], $args);
            } else {
                return header('location:/login');
            }
        }
        return view('errors.403');
    }

    protected function index()
    {
        if (!isAdmin()) {
            return view('errors.403');
        }

        $orders = app()->db->raw('SELECT orders.id,order_date,order_status,total_amount,name FROM orders,users WHERE orders.user_id = users.id ORDER BY order_date DESC');
        return view('admin.orders', 'admin', ['orders' => $orders]);
    }

    protected function store()
    {

        header('Content-Type: application/json');

        $userId = $_SESSION['id'];
        if (isAdmin()) {
            $userId = (int)request('uid');
        }
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
            $orderId = Order::create(['user_id' => $userId, 'total_amount' => 0]);
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

    protected function destroy()
    {
        if (!isAdmin()) {
            return view('errors.403');
        }

        $orderId = (int)request()->get('id');
        if (!$orderId) {
            return view('errors.404');
        }
        Order::delete($orderId);
        return back();
    }

    protected function setDone()
    {
        if (!isAdmin()) {
            return view('errors.403');
        }

        $orderId = (int)request()->get('id');
        if (!$orderId) {
            return view('errors.404');
        }
        Order::update($orderId, ['order_status' => 'done']);
        return back();

    }

    protected function create()
    {
        $users = app()->db->raw('SELECT id,name FROM users');
        $products = app()->db->raw('SELECT id,prd_name,image,price FROM products');
        return view('admin.manual_orders', 'admin', ['users' => $users, 'products' => $products]);
    }

    protected function products()
    {
        $orderId = request('id');
        if (isAdmin()) {
            $products = app()->db->raw('SELECT prd_name,quantity,image FROM products,order_products WHERE products.id = order_products.product_id AND order_products.order_id=?', [$orderId]);
        } else {
            $products = app()->db->raw('SELECT prd_name,quantity,image FROM products,order_products,orders WHERE orders.user_id = ? AND products.id = order_products.product_id AND order_products.order_id=? GROUP BY products.id', [$_SESSION['id'], $orderId]);
        }
        header('Content-Type: application/json');
        echo json_encode($products);
    }

    protected function processing()
    {
        $page = request()->get('page') ?? 1; //used to paginate query to improve performance as usual
        $orders = app()->db->raw("SELECT orders.id,order_date,total_amount,name,ext,room FROM orders,users WHERE orders.user_id = users.id AND orders.order_status='processing'");
        return view('admin.processingOrders', 'admin', ['orders' => $orders]);
    }

    protected function show()
    {
        $orderId = request('id');
        $products = app()->db->raw('SELECT prd_name,quantity,image FROM products,order_products WHERE products.id = order_products.product_id AND order_products.order_id=?', [$orderId]);
        return view('admin.order_details', 'admin', ['products' => $products]);

    }

}
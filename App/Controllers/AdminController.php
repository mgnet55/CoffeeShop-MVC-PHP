<?php

namespace App\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderProducts;
use App\Models\Product;
use App\Models\User;

use Exception;

use PhpMvc\Validation\Validator;

class AdminController
{
    public function __construct()
    {
        if (!isAdmin()) return View('errors.403');
    }

    public function index()
    {

        $ordersCount = app()->db->raw('SELECT count(*) FROM orders')[0]['count(*)'];
        $usersCount = app()->db->raw('SELECT count(*) FROM users')[0]['count(*)'];
        $ordersTotal = app()->db->raw('SELECT sum(total_amount) FROM orders')[0]['sum(total_amount)'];
        $ordersProcessing = app()->db->raw("SELECT count(*) FROM orders WHERE order_status = 'processing'")[0]['count(*)'];

        return view('admin.home', 'admin', ['ordersCount' => $ordersCount, 'ordersTotal' => $ordersTotal, 'usersCount' => $usersCount, 'ordersProcessing' => $ordersProcessing]);
    }

    //TODO  USER functions===============================================
    public function postEditUser()
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

    public function getAddUser()
    {
        return view('admin.addUser', 'admin');
    }

    public function postAddUser()
    {
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

    public function getEditUser()
    {
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

    public function deleteUser()
    {
        $userId = (int)request()->get('id');
        if (!$userId) {
            return view('errors.404');
        }
        User::delete($userId);
        return view('admin.users', 'admin');
    }

    public function allUsers()
    {
        if (isAdmin()) {
            $page = request()->get('page') ?? 1;
            $users = User::all($page);
            return view('admin.users', 'admin', ['users' => $users, 'page' => $page]);
        }
        return view('errors.403');
    }

    //TODO  PRODUCTS functions===============================================

    public function addGetProduct()
    {
        $categories = $this->allCategories();
        return view('admin.addProduct', 'admin', ['categories' => $categories]);

    }

    public function postAddProduct()
    {
        if (!isAdmin()) {
            return view('erros.403');
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

    public function getEditProduct()
    {
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

    public function deleteProduct()
    {
        $productId = (int)request()->get('id');
        if (!$productId) {
            return view('errors.404');
        }
        Product::delete($productId);
        header('location:/admin/products');
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

    public function postEditProduct()
    {

        if (!isAdmin()) {
            return view('erros.403');
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

    //TODO  ORDERS functions===============================================
    //add order for user {returns all products and users}
    public function allOrders()
    {
        if (isAdmin()) {
            //$page = request()->get('page') ?? 1; //used to paginate query to improve performance as usual
            $orders = app()->db->raw('SELECT orders.id,order_date,order_status,total_amount,name FROM orders,users WHERE orders.user_id = users.id ORDER BY order_date DESC');
            return view('admin.orders', 'admin', ['orders' => $orders]);
        }
        return view('errors.403');
    }

    public function processingOrders()
    {
        if (isAdmin()) {
            $page = request()->get('page') ?? 1; //used to paginate query to improve performance as usual
            $orders = app()->db->raw("SELECT orders.id,order_date,total_amount,name,ext,room FROM orders,users WHERE orders.user_id = users.id AND orders.order_status='processing'");
            return view('admin.processingOrders', 'admin', ['orders' => $orders]);
        }
        return view('errors.403');
    }

    public function getManualOrder()
    {
        $users = app()->db->raw('SELECT id,name FROM users');
        $products = app()->db->raw('SELECT id,prd_name,image,price FROM products');
        return view('admin.manual_orders', 'admin', ['users' => $users, 'products' => $products]);
    }

    public function postManualOrder()
    {

    }

    public function userOrders()
    {
        if (!$_SESSION['type']) {
            return "Not Authorized";
        }
        $userId = request('id');
        header('Content-Type: application/json');
        echo json_encode(Order::where('1', ['user_id=', $userId]));
    }

    public function orderProducts()
    {
        if (!$_SESSION['type']) {
            return "Not Authorized";
        }
        $orderId = request('id');
        $product = app()->db->raw('SELECT prd_name,quantity,image FROM products,order_products WHERE products.id = order_products.product_id AND order_products.order_id=?',[$orderId]);
        header('Content-Type: application/json');
        echo json_encode($product);
    }

    public function deleteOrder()
    {
        $orderId = (int)request()->get('id');
        if (!$orderId) {
            return view('errors.404');
        }
        Order::delete($orderId);
        header('location:/admin/orders');
    }

    public function setOrderDone()
    {
        $orderId = (int)request()->get('id');
        if (!$orderId) {
            return view('errors.404');
        }
        Order::update($orderId,['order_status'=>'done']);
        header('location:/admin/orders/processing');

    }

    public function allCategories()
    {
        //header('Content-Type: application/json');
        return Category::all(1);
    }

    public function user_orders()
    {
        $id = request('id');
        if (!$id) {return view('errors.404');}
        $orders = Order::where(1, ['user_id=', $id]);
        return view('admin.user_orders','admin',['orders'=>$orders]);

    }
}
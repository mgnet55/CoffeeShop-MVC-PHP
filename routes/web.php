<?php

use App\Controllers\LoginController;
use App\Controllers\UserController;
use PhpMvc\Http\Route;

Route::GET('orderdetails',[UserController::class,'orderDetails']);
Route::GET('',[UserController::class,'allproducts']);
Route::GET('home',[UserController::class,'allproducts']);

Route::POST('orders',[UserController::class,'postAddOrder']);
Route::GET('orders',[UserController::class,'getUserOrders']);
Route::POST('neworder',[UserController::class,'postAddOrder']);
//login routes
Route::GET('login',[LoginController::class,'index']);
Route::POST('login',[LoginController::class,'login']);
Route::GET('logout',[LoginController::class,'logout']);
Route::GET('admin/logout',[LoginController::class,'logout']);

//register routes
//Route::GET('register',[RegisterController::class,'index']);
//Route::POST('register',[RegisterController::class,'store']);
//home
//Route::GET('/home', [HomeController::class,'index']);
//Route::GET('/', [HomeController::class,'index']);

//Route::GET('/', [HomeController::class,'index']);
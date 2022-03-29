<?php

use App\Controllers\ForgetPassword;
use App\Controllers\HomeController;
use App\Controllers\OrderController;
use App\Controllers\ProductController;
use App\Controllers\UserController;
use PhpMvc\Http\Route;

//auth routes
Route::GET('login',[HomeController::class,'login']);
Route::POST('login',[HomeController::class,'auth']);
Route::GET('logout',[HomeController::class,'logout']);

//Home routes
Route::GET('/',[HomeController::class,'index']);
Route::GET('admin',[HomeController::class,'index']);

//users management
Route::GET('admin/users',[UserController::class,'index']);
Route::GET('admin/users/add',[UserController::class,'create']);
Route::GET('admin/users/delete',[UserController::class,'destroy']);
Route::POST('admin/users/add',[UserController::class,'store']);
Route::GET('admin/users/edit',[UserController::class,'edit']);
Route::POST('admin/users/edit',[UserController::class,'update']);
Route::GET('admin/users/checks',[UserController::class,'orders']);
Route::GET('orders',[UserController::class,'orders']);

//products management
Route::GET('admin/products',[ProductController::class,'index']);
Route::GET('admin/products/add',[ProductController::class,'create']);
Route::POST('admin/products/add',[ProductController::class,'store']);
Route::GET('admin/products/edit',[ProductController::class,'edit']);
Route::POST('admin/products/edit',[ProductController::class,'update']);
Route::GET('admin/products/delete',[ProductController::class,'destroy']);

//orders management
Route::GET('admin/orders',[OrderController::class,'index']);
Route::GET('admin/orders/add',[OrderController::class,'create']);
Route::GET('orderdetails',[OrderController::class,'products']);
Route::POST('neworder',[OrderController::class,'store']);
Route::GET('orders/processing',[OrderController::class,'processing']);
Route::GET('orders/details',[OrderController::class,'show']);
Route::GET('orders/delete',[OrderController::class,'destroy']);
Route::GET('orders/done',[OrderController::class,'setDone']);

//Password Reset
Route::GET('forget',[ForgetPassword::class,'forget']);
Route::POST('forget',[ForgetPassword::class,'generate_token']);
Route::GET('reset',[ForgetPassword::class,'reset']);
Route::POST('reset',[ForgetPassword::class,'updatePassword']);
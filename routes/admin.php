<?php

use App\Controllers\AdminController;
use PhpMvc\Http\Route;

//products

////products management
//Route::GET('products',[ProductController::class,'get']);
//Route::GET('products/add', static function(){return view('products.add','main');});
//Route::POST('products/add',[ProductController::class,'store']);
//Route::GET('products/edit',[ProductController::class,'get']);
//Route::POST('products/edit',[ProductController::class,'update']);
//Route::GET('products/delete',[ProductController::class,'delete']);

////users management

//Route::GET('users',[UserController::class,'get']);
//Route::GET('users/add',[UserController::class,'new']);
//Route::POST('users/add',[UserController::class,'get']);

//Route::GET('users',[UserController::class,'get']);
//Route::GET('users/add',[UserController::class,'new']);
//Route::POST('users/add',[UserController::class,'get']);

Route::GET('admin',[AdminController::class,'index']);

////users management
Route::GET('admin/users',[AdminController::class,'allUsers']);
Route::GET('admin/users/add',[AdminController::class,'getAddUser']);
Route::POST('admin/users/add',[AdminController::class,'store']);

//products management
Route::GET('admin/products',[AdminController::class,'allProducts']);
Route::GET('admin/products/add',[AdminController::class,'GetaddProduct']);
Route::POST('admin/products/add',[AdminController::class,'addProduct']);

//orders management
Route::GET('admin/orders',[AdminController::class,'allOrders']);
Route::GET('admin/orders/add',[AdminController::class,'manualOrders']);
//Route::GET('admin/users',static function(){return view('admin.users','admin');});




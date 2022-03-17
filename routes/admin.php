<?php

use App\Controllers\AdminController;
use PhpMvc\Http\Route;

Route::GET('admin',[AdminController::class,'index']);

////users management
Route::GET('admin/users',[AdminController::class,'allUsers']);
Route::GET('admin/users/add',[AdminController::class,'getAddUser']);
Route::POST('admin/users/add',[AdminController::class,'postAddUser']);
Route::GET('admin/users/edit',[AdminController::class,'getEditUser']);
Route::POST('admin/users/edit',[AdminController::class,'postEditUser']);

//products management
Route::GET('admin/products',[AdminController::class,'allProducts']);
Route::GET('admin/products/add',[AdminController::class,'addGetProduct']);
Route::POST('admin/products/add',[AdminController::class,'postAddProduct']);
Route::GET('admin/products/edit',[AdminController::class,'getEditProduct']);
Route::POST('admin/products/edit',[AdminController::class,'postEditProduct']);
Route::GET('admin/products/delete',[AdminController::class,'deleteProduct']);

//orders management
Route::GET('admin/orders',[AdminController::class,'allOrders']);
Route::GET('admin/orders/add',[AdminController::class,'manualOrders']);
Route::GET('admin/orders/processing',[AdminController::class,'processingOrders']);
Route::GET('admin/orders/delete',[AdminController::class,'deleteOrder']);
Route::GET('admin/orders/done',[AdminController::class,'setOrderDone']);


//Route::GET('admin/users',static function(){return view('admin.users','admin');});


//orders management
Route::GET('admin/orders/add',[AdminController::class,'manualOrders']);

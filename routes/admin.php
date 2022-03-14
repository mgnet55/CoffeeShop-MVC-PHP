<?php

//products
use App\Controllers\ProductController;
use App\Controllers\UserController;
use PhpMvc\Http\Route;

//products management
Route::GET('product/',[ProductController::class,'get']);

Route::GET('product/add', static function(){return view('products.add','main');});
Route::POST('product/add',[ProductController::class,'store']);

Route::GET('product/edit',[ProductController::class,'get']);
Route::POST('product/edit',[ProductController::class,'update']);

Route::GET('product/delete',[ProductController::class,'delete']);

//users management
Route::GET('users',[UserController::class,'get']);



//orders management
<?php

//products
use App\Controllers\ProductController;
use App\Controllers\UserController;
use PhpMvc\Http\Route;

//products management
Route::GET('products',[ProductController::class,'get']);
Route::GET('products/add', static function(){return view('products.add','main');});
Route::POST('products/add',[ProductController::class,'store']);
Route::GET('products/edit',[ProductController::class,'get']);
Route::POST('products/edit',[ProductController::class,'update']);
Route::GET('products/delete',[ProductController::class,'delete']);

//users management
Route::GET('users',[UserController::class,'get']);
Route::GET('users/add',[UserController::class,'new']);
Route::POST('users/add',[UserController::class,'get']);



//orders management
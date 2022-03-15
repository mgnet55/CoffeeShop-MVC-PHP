<?php

use App\Controllers\LoginController;
use App\Controllers\old_controllers\HomeController;
use App\Controllers\old_controllers\RegisterController;
use PhpMvc\Http\Route;

//home
Route::GET('/home', [HomeController::class,'index']);
Route::GET('/', [HomeController::class,'index']);

//register routes
Route::GET('register',[RegisterController::class,'index']);
Route::POST('register',[RegisterController::class,'store']);

//login routes
Route::GET('login',[LoginController::class,'index']);
Route::POST('login',[LoginController::class,'login']);
Route::GET('logout',[LoginController::class,'logout']);
Route::GET('admin/logout',[LoginController::class,'logout']);


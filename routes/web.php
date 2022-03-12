<?php

use App\Controllers\HomeController;
use App\Controllers\RegisterController;
use PhpMvc\Http\Route;

//home
Route::GET('/', [HomeController::class,'index']);

//register routes
Route::GET('register',[RegisterController::class,'index']);
Route::POST('register',[RegisterController::class,'store']);

//login routes
<?php

use App\Controllers\Auth\LoginController;
use Trinto\Http\Route;
use App\Controllers\HomeController;
use App\Controllers\Auth\RegisterController;


Route::get('/', [HomeController::class, 'index']);

Route::get('/signup', [RegisterController::class, 'index']);

Route::post('/signup', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'index']);

Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LoginController::class, 'logout']);
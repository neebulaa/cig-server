<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => "auth"], function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/', function () {
        return view('home');
    });

    Route::get('/page-content', function () {
        return view('page-content.index');
    });

    Route::get('/products', function () {
        return view('products.index');
    });

    Route::get('/comodities', function () {
        return view('comodities.index');
    });

    Route::get('/users', function () {
        return view('users.index');
    });
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate']);
});

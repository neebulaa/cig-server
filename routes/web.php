<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageContentController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => "auth"], function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/', function () {
        return view('home');
    });

    Route::get('/page-content/main', [PageContentController::class, 'main']);
    Route::get('/page-content/products', [PageContentController::class, 'products']);
    Route::get('/page-content/articles', [PageContentController::class, 'articles']);

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

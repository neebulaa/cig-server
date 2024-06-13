<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PageContentController;
use App\Http\Controllers\Api\PinpointController;

Route::put('/page-content/main/{page_content}', [PageContentController::class, 'main_update']);
Route::put('/pinpoints', [PinpointController::class, 'update']);


Route::get('/page-contents', [PageContentController::class, 'index']);

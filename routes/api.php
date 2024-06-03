<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PageContentController;

Route::put('/page-content/main/{page_content}', [PageContentController::class, 'main_update']);

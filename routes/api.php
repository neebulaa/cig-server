<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\SocialController;
use App\Http\Controllers\Api\VisionController;
use App\Http\Controllers\Api\BenefitController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ComodityController;
use App\Http\Controllers\Api\PinpointController;
use App\Http\Controllers\Api\TeamMemberController;
use App\Http\Controllers\Api\PageContentController;
use App\Http\Controllers\Api\CertificationController;

Route::put('/page-content/main/{page_content}', [PageContentController::class, 'main_update']);
Route::put('/pinpoints', [PinpointController::class, 'update']);


Route::get('/page_contents', [PageContentController::class, 'index']);
Route::get('/pinpoints', [PinpointController::class, 'index']);
Route::get('/visions', [VisionController::class, 'index']);
Route::get('/benefits', [BenefitController::class, 'index']);
Route::get('/products', [ProductController::class, 'index']);
Route::get('/catalog', [ProductController::class, 'catalog']);
Route::get('/comodities', [ComodityController::class, 'index']);
Route::get('/team_members', [TeamMemberController::class, 'index']);
Route::get('/clients', [ClientController::class, 'index']);
Route::get('/articles', [PostController::class, 'index']);
Route::get('/certifications', [CertificationController::class, 'index']);
Route::get('/socials', [SocialController::class, 'index']);
Route::get('/my_company', [CompanyController::class, 'my_company']);

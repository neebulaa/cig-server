<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Client;
use App\Models\Region;
use App\Models\Product;
use App\Models\Category;
use App\Models\Pinpoint;
use App\Models\Certification;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\VisionController;
use App\Http\Controllers\BenefitController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ComodityController;
use App\Http\Controllers\PinpointController;
use App\Http\Controllers\TeamMemberController;
use App\Http\Controllers\PageContentController;
use App\Http\Controllers\CertificationController;
use App\Http\Controllers\EditorController;

Route::group(['middleware' => "auth"], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/', function () {
        return view('home', [
            "pinpoints" => Pinpoint::latest()->get(),
            "products" => Product::with('comodities')->latest()->get(),
            "posts" => Post::with('category')->latest()->get(),
            "clients" => Client::latest()->get(),
            "regions" => Region::latest()->get(),
            "certifications" => Certification::latest()->get(),
            "categories" => Category::latest()->get(),
        ]);
    });

    // editors
    Route::middleware('owner')->group(function () {
        Route::get('/editors', [EditorController::class, 'index']);
        Route::post('/editors', [EditorController::class, 'store']);
        Route::put('/editors/{user:username}', [EditorController::class, 'update']);
        Route::delete('/editors/{user:username}', [EditorController::class, 'destroy']);
        Route::get('/editors/create', [EditorController::class, 'create']);
        Route::get('/editors/edit/{user:username}', [EditorController::class, 'edit']);
        Route::get('/editors/change-password/{user:username}', [EditorController::class, 'change_password']);
        Route::put('/editors/change-password/{user:username}', [EditorController::class, 'change_password_update']);
    });

    // page content
    Route::get('/page-content/{page}', [PageContentController::class, 'index']);

    // product
    Route::get('/products/create_slug', [ProductController::class, 'create_slug']);
    Route::get('/products', [ProductController::class, 'index']);
    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{product:slug}', [ProductController::class, 'update']);
    Route::delete('/products/{product:slug}', [ProductController::class, 'destroy']);
    Route::get('/products/create', [ProductController::class, 'create']);
    Route::get('/products/edit/{product:slug}', [ProductController::class, 'edit']);
    Route::get('/products/{product:slug}', [ProductController::class, 'show']);

    // comodity
    Route::get('/comodities/create_slug', [ComodityController::class, 'create_slug']);
    Route::get('/comodities', [ComodityController::class, 'index']);
    Route::post('/comodities', [ComodityController::class, 'store']);
    Route::put('/comodities/{comodity:slug}', [ComodityController::class, 'update']);
    Route::delete('/comodities/{comodity:slug}', [ComodityController::class, 'destroy']);
    Route::get('/comodities/create', [ComodityController::class, 'create']);
    Route::get('/comodities/edit/{comodity:slug}', [ComodityController::class, 'edit']);

    // client
    Route::get('/clients/create_slug', [ClientController::class, 'create_slug']);
    Route::get('/clients', [ClientController::class, 'index']);
    Route::post('/clients', [ClientController::class, 'store']);
    Route::put('/clients/{client:slug}', [ClientController::class, 'update']);
    Route::delete('/clients/{client:slug}', [ClientController::class, 'destroy']);
    Route::get('/clients/create', [ClientController::class, 'create']);
    Route::get('/clients/edit/{client:slug}', [ClientController::class, 'edit']);

    // client
    Route::get('/companies/create_slug', [CompanyController::class, 'create_slug']);
    Route::get('/companies', [CompanyController::class, 'index']);
    Route::post('/companies', [CompanyController::class, 'store']);
    Route::put('/companies/{company:slug}', [CompanyController::class, 'update']);
    Route::delete('/companies/{company:slug}', [CompanyController::class, 'destroy']);
    Route::get('/companies/create', [CompanyController::class, 'create']);
    Route::get('/companies/edit/{company:slug}', [CompanyController::class, 'edit']);
    Route::get('/companies/{company:slug}', [CompanyController::class, 'show']);

    // socials
    Route::get('/socials', [SocialController::class, 'index']);
    Route::post('/socials', [SocialController::class, 'store']);
    Route::put('/socials/{social}', [SocialController::class, 'update']);
    Route::delete('/socials/{social}', [SocialController::class, 'destroy']);
    Route::get('/socials/create', [SocialController::class, 'create']);
    Route::get('/socials/edit/{social}', [SocialController::class, 'edit']);

    // team members
    Route::get('/team-members/create_slug', [TeamMemberController::class, 'create_slug']);
    Route::get('/team-members', [TeamMemberController::class, 'index']);
    Route::post('/team-members', [TeamMemberController::class, 'store']);
    Route::get('/team-members/create', [TeamMemberController::class, 'create']);
    Route::get('/team-members/edit/{team_member:slug}', [TeamMemberController::class, 'edit']);
    Route::get('/team-members/{team_member:slug}', [TeamMemberController::class, 'show']);
    Route::put('/team-members/{team_member:slug}', [TeamMemberController::class, 'update']);
    Route::delete('/team-members/{team_member:slug}', [TeamMemberController::class, 'destroy']);

    // visions
    Route::get('/visions/create_slug', [VisionController::class, 'create_slug']);
    Route::get('/visions', [VisionController::class, 'index']);
    Route::post('/visions', [VisionController::class, 'store']);
    Route::put('/visions/{vision:slug}', [VisionController::class, 'update']);
    Route::delete('/visions/{vision:slug}', [VisionController::class, 'destroy']);
    Route::get('/visions/create', [VisionController::class, 'create']);
    Route::get('/visions/edit/{vision:slug}', [VisionController::class, 'edit']);
    Route::get('/visions/{vision:slug}', [VisionController::class, 'show']);

    // benefits
    Route::get('/benefits/create_slug', [BenefitController::class, 'create_slug']);
    Route::get('/benefits', [BenefitController::class, 'index']);
    Route::post('/benefits', [BenefitController::class, 'store']);
    Route::put('/benefits/{benefit:slug}', [BenefitController::class, 'update']);
    Route::delete('/benefits/{benefit:slug}', [BenefitController::class, 'destroy']);
    Route::get('/benefits/create', [BenefitController::class, 'create']);
    Route::get('/benefits/edit/{benefit:slug}', [BenefitController::class, 'edit']);
    Route::get('/benefits/{benefit:slug}', [BenefitController::class, 'show']);

    // post categories
    Route::get('/categories/create_slug', [CategoryController::class, 'create_slug']);
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::put('/categories/{category:slug}', [CategoryController::class, 'update']);
    Route::delete('/categories/{category:slug}', [CategoryController::class, 'destroy']);
    Route::get('/categories/create', [CategoryController::class, 'create']);
    Route::get('/categories/edit/{category:slug}', [CategoryController::class, 'edit']);

    // posts
    Route::get('/posts/create_slug', [PostController::class, 'create_slug']);
    Route::get('/posts', [PostController::class, 'index']);
    Route::post('/posts', [PostController::class, 'store']);
    Route::put('/posts/{post:slug}', [PostController::class, 'update']);
    Route::delete('/posts/{post:slug}', [PostController::class, 'destroy']);
    Route::get('/posts/create', [PostController::class, 'create']);
    Route::get('/posts/edit/{post:slug}', [PostController::class, 'edit']);
    Route::get('/posts/{post:slug}', [PostController::class, 'show']);

    // certifications
    Route::get('/certifications/create_slug',    [CertificationController::class, 'create_slug']);
    Route::get('/certifications', [CertificationController::class, 'index']);
    Route::post('/certifications', [CertificationController::class, 'store']);
    Route::put('/certifications/{certification:slug}', [CertificationController::class, 'update']);
    Route::delete('/certifications/{certification:slug}', [CertificationController::class, 'destroy']);
    Route::get('/certifications/create', [CertificationController::class, 'create']);
    Route::get('/certifications/edit/{certification:slug}', [CertificationController::class, 'edit']);
    Route::get('/certifications/{certification:slug}', [CertificationController::class, 'show']);

    // regions
    Route::get('/regions/create_slug',    [RegionController::class, 'create_slug']);
    Route::get('/regions', [RegionController::class, 'index']);
    Route::post('/regions', [RegionController::class, 'store']);
    Route::put('/regions/{region:slug}', [RegionController::class, 'update']);
    Route::delete('/regions/{region:slug}', [RegionController::class, 'destroy']);
    Route::get('/regions/create', [RegionController::class, 'create']);
    Route::get('/regions/edit/{region:slug}', [RegionController::class, 'edit']);
    Route::get('/regions/{region:slug}', [RegionController::class, 'show']);

    // pinpoint
    Route::get('/pinpoints', [PinpointController::class, 'index']);
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate']);
});

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\SocialController;
use App\Http\Controllers\Api\VisionController;
use App\Http\Controllers\Api\BenefitController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ComodityController;
use App\Http\Controllers\Api\PinpointController;
use App\Http\Controllers\Api\TeamMemberController;
use App\Http\Controllers\Api\PageContentController;
use App\Http\Controllers\Api\CertificationController;
use App\Http\Controllers\Api\RegionController;
use App\Models\TableFilter;

Route::put('/page-content/main/{page_content}', [PageContentController::class, 'main_update']);
Route::put('/pinpoints', [PinpointController::class, 'update']);


Route::get('/page_contents', [PageContentController::class, 'index']);
Route::get('/pinpoints', [PinpointController::class, 'index']);
Route::get('/visions', [VisionController::class, 'index']);
Route::get('/benefits', [BenefitController::class, 'index']);
Route::get('/products', [ProductController::class, 'index']);
Route::get('/catalog', [ProductController::class, 'catalog']);
Route::get('/comodities', [ComodityController::class, 'index']);
Route::get('/regions', [RegionController::class, 'index']);
Route::get('/team_members', [TeamMemberController::class, 'index']);
Route::get('/clients', [ClientController::class, 'index']);
Route::get('/articles', [PostController::class, 'index']);
Route::get('/articles/{slug}', [PostController::class, 'show']);
Route::get('/certifications', [CertificationController::class, 'index']);
Route::get('/socials', [SocialController::class, 'index']);
Route::get('/my_company', [CompanyController::class, 'my_company']);
Route::get('/filters', function () {
    $filters = TableFilter::all();
    return response([
        'message' => "Get all table filters success",
        "filters" => $filters
    ]);
});

Route::get('/images/{image_path}', function ($image_path) {
    $filePath = public_path("images/$image_path");
    if (File::exists($filePath)) {
        return response()->file($filePath);
    }

    return response([
        'message' => "Image not found!"
    ], 404);
})->where('image_path', '.*');

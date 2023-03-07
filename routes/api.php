<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ArticleCategoryController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\Utility\ProvideAssetAccessToken;
use App\Http\Controllers\ProductCategoryController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user/me', [UserController::class, 'me']);
    Route::post('/logout', [UserController::class, 'logout']);
    Route::post('/user/password', [UserController::class, 'editPassword']);
    Route::post('/company/introduction', [CompanyController::class, 'updateIntroduction']);

    Route::get('/asset-access-token', ProvideAssetAccessToken::class);

    Route::apiResources([
        'user' => UserController::class,
        'carousel' => CarouselController::class,
        'article' => ArticleController::class,
        'article-category' => ArticleCategoryController::class,
        'company' => CompanyController::class,
        'product-category' => ProductCategoryController::class,
    ]);
});
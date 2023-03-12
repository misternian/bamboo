<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ArticleCategoryController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductPropertyController;
use App\Http\Controllers\ProductSpuController;
use App\Http\Controllers\ProductSkuController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ClientTypeController;
use App\Http\Controllers\Utility\ProvideAssetAccessToken;

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

    Route::post('/product-spu-image', [ProductSpuController::class, 'editImage']);
    Route::post('/product-spu-code', [ProductSpuController::class, 'editSpuCode']);
    Route::post('/product-spu-title', [ProductSpuController::class, 'editTitle']);
    Route::post('/product-spu-category', [ProductSpuController::class, 'editCategory']);
    Route::post('/product-spu-service', [ProductSpuController::class, 'editSpuService']);
    Route::post('/product-spu-note', [ProductSpuController::class, 'editSpuNote']);

    Route::post('/product-sku-image', [ProductSkuController::class, 'editImage']);
    Route::post('/product-sku-code', [ProductSkuController::class, 'editSkuCode']);
    Route::post('/product-sku-name', [ProductSkuController::class, 'editName']);
    Route::post('/product-sku-remark', [ProductSkuController::class, 'editRemark']);

    Route::apiResources([
        'user' => UserController::class,
        'carousel' => CarouselController::class,
        'article' => ArticleController::class,
        'article-category' => ArticleCategoryController::class,
        'company' => CompanyController::class,
        'site' => SiteController::class,
        'product-category' => ProductCategoryController::class,
        'product-property' => ProductPropertyController::class,
        'product-type' => ProductTypeController::class,
        'product-spu' => ProductSpuController::class,
        'product-sku' => ProductSkuController::class,
        'client' => ClientController::class,
        'client-type' => ClientTypeController::class,
    ]);
});
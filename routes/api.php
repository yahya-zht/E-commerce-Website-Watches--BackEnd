<?php

use App\Http\Controllers\API\Auth\PassportAuthController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\CustomerController;
use App\Http\Controllers\API\DashboardController;
use App\Http\Controllers\API\GuestController;
use App\Http\Controllers\API\MessageController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\ProviderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('register',[PassportAuthController::class,'register']);
Route::post('login',[PassportAuthController::class,'login']);
Route::middleware(['auth:api'])->group(function(){
    Route::post('Admin/logout',[PassportAuthController::class,'logout']);
    Route::get('Admin/userInfo',[PassportAuthController::class,'userInfo']);
    Route::resource('Admin/Providers',ProviderController::class);
    Route::resource('Admin/Categories',CategoryController::class);
    Route::resource('Admin/Products',ProductController::class);
    Route::resource('Admin/Customers',CustomerController::class);
    Route::resource('Admin/Orders',OrderController::class);
    Route::resource('Admin/Messages',MessageController::class);
    Route::get('Admin/Messages/{id}/download',[MessageController::class,'downloadPDF']);
    Route::get('Admin/Dashboard',[DashboardController::class,'index']);
});
Route::post('Message',[MessageController::class,'store']);
Route::post('Order',[OrderController::class,'store'])->name('Order');
Route::get('products',[GuestController::class,'Products']);
Route::get('products/{id}',[GuestController::class,'ShowProduct']);
Route::get('categories',[GuestController::class,'Categories']);

Route::get('Admin/products/search/{query}', [ProductController::class,'search']);
Route::get('Admin/Orders/search/{query}', [OrderController::class,'search']);
Route::get('Admin/Customers/search/{query}', [CustomerController::class,'search']);
Route::get('Admin/Categories/search/{query}', [CategoryController::class,'search']);
Route::get('Admin/Providers/search/{query}', [ProviderController::class,'search']);

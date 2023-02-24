<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CounterpartyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductfolderController;
use App\Http\Controllers\StoreController;
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


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function() {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::middleware('can:operable')->group(function() {
        Route::post('products', [ProductController::class, 'createProduct']);
        Route::get('products/{id}', [ProductController::class, 'getProduct']);
        Route::put('products', [ProductController::class, 'updateProduct']);
        Route::delete('products/{id}', [ProductController::class, 'deleteProduct']);

        Route::post('counterparties', [CounterpartyController::class, 'createCounterparty']);
        Route::get('counterparties/{id}', [CounterpartyController::class, 'getCounterparty']);
        Route::put('counterparties', [CounterpartyController::class, 'updateCounterparty']);
        Route::delete('counterparties/{id}', [CounterpartyController::class, 'deleteCounterparty']);

        Route::post('stores', [StoreController::class, 'createStore']);
        Route::get('stores/{id}', [StoreController::class, 'getStore']);
        Route::put('stores', [StoreController::class, 'updateStore']);
        Route::delete('stores/{id}', [StoreController::class, 'deleteStore']);

        Route::post('productfolders', [ProductfolderController::class, 'createProductfolder']);
        Route::get('productfolders/{id}', [ProductfolderController::class, 'getProductfolder']);
        Route::put('productfolders', [ProductfolderController::class, 'updateProductfolder']);
        Route::delete('productfolders/{id}', [ProductfolderController::class, 'deleteProductfolder']);
    });
});




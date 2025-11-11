<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\OurTeamController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CheckOutController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth:sanctum');


Route::get('/products', [ProductController::class, 'index']);
Route::get('/about', [AboutController::class, 'index']);
Route::get('/ourTeam', [OurTeamController::class, 'index']);



Route::post('/contacts', [ContactController::class, 'store']);


//Users
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/cart', [CartController::class, 'index']);
    Route::post('/cart/{productId}', [CartController::class, 'addToCart']);
    Route::delete('/cart/{productId}', [CartController::class, 'removeFromCart']);
    Route::put('/cart/{productId}/quantity', [CartController::class, 'updateQuantity']);


    Route::post('/checkout', [CheckOutController::class, 'processCheckout']);
});


//Admins
Route::middleware('auth:sanctum', 'isAdmin')->group(function () {

        Route::get('/users', [UserController::class, 'getUsers']);
    
    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);

    Route::put('/about/{id}', [AboutController::class, 'update']);

    Route::post('/ourTeam', [OurTeamController::class, 'store']);
    Route::put('/ourTeam/{id}', [OurTeamController::class, 'update']);
    Route::delete('/ourTeam/{id}', [OurTeamController::class, 'destroy']);



    Route::get('/orders', [OrderController::class, 'index']);
    Route::post('/orders', [OrderController::class, 'store']);
    Route::delete('/orders/{id}', [OrderController::class, 'destroy']);
    Route::put('/orders/{id}', [OrderController::class, 'update']);

    
    Route::get('/contacts', [ContactController::class, 'index']);
        Route::delete('/contacts/{id}', [ContactController::class, 'destroy']);

    Route::put('/users/{id}/role', [UserController::class, 'updateRole']);
    
});

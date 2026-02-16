<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\CartItemOptionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\OrderItemOptionController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductOptionController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/auth/register', [UserController::class, 'register']);
Route::post('/auth/login', [UserController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [UserController::class, 'me']);
    Route::get('/users', [UserController::class, 'getAllUsers']);
    Route::get('/user/{id}', [UserController::class, 'getUserById']);

    Route::get('/restaurants', [RestaurantController::class, 'index']);
    Route::get('/restaurant/{restaurant}', [RestaurantController::class, 'show']);

    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/{restaurant}', [CategoryController::class, 'show']);

    Route::get('/restaurants/{restaurant}/products', [ProductController::class, 'index']);
    Route::get('/product/{product}', [ProductController::class, 'show']);

    Route::get('/products/options/{product}', [ProductOptionController::class, 'index']);
    Route::get('/product/option/{productOption}', [ProductOptionController::class, 'show']);

    Route::get('/orders', [OrderController::class, 'index']);
    Route::get('/order/{order}', [OrderController::class, 'show']);


    Route::middleware('role:Customer')->group(function () {
        Route::post('cart/create', [CartController::class, 'store']);
        Route::get('cart/{restaurant}', [CartController::class, 'show']);
        Route::delete('cart/delete/{restaurant}', [CartController::class, 'destroy']);

        Route::post('/restaurants/{restaurant}/cart/items', [CartItemController::class, 'store']);
        Route::put('/cart/items/update/{cartItem}', [CartItemController::class, 'update']);
        Route::delete('/cart/items/delete/{cartItem}', [CartItemController::class, 'destroy']);

        Route::post('/cart/item/{cartItem}/option', [CartItemOptionController::class, 'store']);
        Route::delete('/cart/item/{cartItemOption}/option', [CartItemOptionController::class, 'destroy']);

        Route::post('/order/create', [OrderController::class, 'store']);

        Route::get('/order/items/{order}', [OrderItemController::class, 'index']);
        Route::post('/order/items', [OrderItemController::class, 'store']);
        Route::put('/order/item/update/{orderItem}', [OrderItemController::class, 'update']);
        Route::delete('/order/item/delete/{orderItem}', [OrderItemController::class, 'destroy']);

        Route::apiResource('/address', AddressController::class);

        Route::post('transaction/recharge', [TransactionController::class, 'store']);
        Route::get('transactions', [TransactionController::class, 'index']);

        Route::post('/payment', [PaymentController::class, 'pay']);
        Route::get('/payment', [PaymentController::class, 'index']);
    });

    Route::middleware('role:Admin')->group(function () {

        Route::delete('/user/{id}', [UserController::class, 'deleteUserById']);
        Route::put('/user/{id}/role', [UserController::class, 'updateUserRole']);
        Route::put('/order/update/{order}', [OrderController::class, 'update']);
        Route::delete('/order/delete/{order}', [OrderController::class, 'destroy']);

        Route::post('/order/item/options/{orderItem}', [OrderItemOptionController::class, 'store']);
        Route::put('/order/item/option/update/{orderItemOption}', [OrderItemOptionController::class, 'update']);
        Route::delete('/order/item/option/delete/{orderItemOption}', [OrderItemOptionController::class, 'destroy']);
    });

    Route::middleware('role:restaurant_owner')->group(function () {
        Route::post('/categories', [CategoryController::class, 'store']);
        Route::post('/restaurant/create', [RestaurantController::class, 'store']);
    });

    Route::middleware('role:Admin,restaurant_owner')->group(function () {
        Route::put('restaurant/update/{restaurant}', [RestaurantController::class, 'update']);
        Route::delete('restaurant/delete/{restaurant}', [RestaurantController::class, 'destroy']);

        Route::put('/categories/update/{category}', [CategoryController::class, 'update']);
        Route::delete('/categories/delete/{category}', [CategoryController::class, 'destroy']);

        Route::post('/product/create', [ProductController::class, 'store']);
        Route::put('/product/update/{product}', [ProductController::class, 'update']);
        Route::delete('/product/delete/{product}', [ProductController::class, 'destroy']);

        Route::post('/product/option/create', [ProductOptionController::class, 'store']);
        Route::put('/product/option/update/{productOption}', [ProductOptionController::class, 'update']);
        Route::delete('/product/option/delete/{productOption}', [ProductOptionController::class, 'destroy']);
    });

    Route::middleware('role:Delivery')->group(function () {
        Route::patch('/order/status/{order}', [OrderController::class, 'updateStatus']);
    });
});

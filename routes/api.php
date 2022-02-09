<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MidtransNotifController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RecipientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// product
Route::get('/product', [ProductController::class, 'index']);
Route::get('/product/{id}', [ProductController::class, 'show']);
Route::get('product/category/{id}', [ProductController::class, 'showProductByCategory']);

// category
Route::get('/category', [CategoryController::class, 'index']);


Route::group(['middleware' => ['jwt.verify']], function () {


    // get User
    Route::get('/user', [AuthController::class, 'show']);

    // product manipulation
    Route::resource('/product', ProductController::class)->except('index', 'show');
    Route::post('/image/{id}', [ProductController::class, 'addImage']);
    Route::delete('/image/{id}', [ProductController::class, 'deleteImage']);

    // cart
    Route::resource('/cart', CartController::class);

    // Order
    Route::resource('/order', OrderController::class);
    Route::post('/order/checkorder', [OrderController::class, 'checkOrder']);

    // category
    Route::resource('/category', CategoryController::class)->except(['index', 'showProductByCategory']);

    // payment
    Route::post('/payment/product', [PaymentController::class, 'buyProduct']);

    // notif midtrans
    Route::post('/notif/submit', [MidtransNotifController::class, 'postNotif']);

    // Recipient
    Route::resource('/recipient', RecipientController::class);
    Route::post('/recipient/shipping', [RecipientController::class, 'checkShipping']);
    Route::post('/recipient/check-cost', [RecipientController::class, 'checkCost']);
    Route::get('/province', [RecipientController::class, 'getProvince']);
    Route::get('/city/{id}', [RecipientController::class, 'getCity']);
});

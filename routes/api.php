<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MidtransNotifController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
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

Route::group(['middleware' => ['jwt.verify']], function () {

    // product manipulation
    Route::resource('/product', ProductController::class);
    Route::post('/image/{id}', [ProductController::class, 'addImage']);
    Route::delete('/image/{id}', [ProductController::class, 'deleteImage']);

    // cart
    Route::resource('/cart', CartController::class);

    // Order
    Route::resource('/order', OrderController::class);
    Route::post('/order/checkorder', [OrderController::class, 'checkOrder']);

    // payment
    Route::post('/payment/product', [PaymentController::class, 'buyProduct']);

    // notif midtrans
    Route::post('/notif/submit', [MidtransNotifController::class, 'postNotif']);
});

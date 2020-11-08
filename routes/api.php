<?php

use App\Domains\Custom\Http\Controllers\Api\PaymentController;
use Illuminate\Http\Request;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

//CUSTOM ROUTES (NEW FILE NOT NEEDED)

Route:: group(['prefix' => 'v1'], function () {
    Route::get('/products', [PaymentController::class, 'index']);
    Route::post('/payment', [PaymentController::class, 'store']);
    Route::get('payment/{reference}', [PaymentController::class, 'show']);
});

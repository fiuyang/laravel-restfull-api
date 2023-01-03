<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\API\ProductController;
use App\Http\Controllers\V1\API\Auth\LoginController;
use App\Http\Controllers\V1\API\Auth\LogoutController;
use App\Http\Controllers\V1\API\Auth\RegisterController;
use App\Http\Controllers\V1\API\Auth\ResetPasswordController;
use App\Http\Controllers\V1\API\Auth\ForgotPasswordController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => 'api'], function () {
    Route::post('register',[RegisterController::class, 'register']);
    Route::post('login',[LoginController::class, 'login']);
    Route::post('forgot-password',[ForgotPasswordController::class, 'forgotPassword']);
    Route::post('reset-password',[ResetPasswordController::class, 'resetPassword']);
});


// Route::group(['middleware' => ['jwt.verify']], function () {
    Route::post('logout',[LogoutController::class, 'logout']);
    Route::get('/query', [ProductController::class, 'loadDataSearchReq']);
    Route::apiResource('products', ProductController::class);
// });


<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;





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


// Route::middleware('auth:api')->get('/user', function(Request $request) {
//     return $request->user();
// });
/* User AuthController */
// Route::post('auth/login',[AuthController::class,'login']);
// Route::post('auth/register',[AuthController::class,'register']);

/* AdminAuthController */
// Route::post('admin/auth/login',[AdminAuthController::class,'login']);

 /* ProductController */

Route::group(['middleware' =>'VerifiyToken'], function () {
    Route::apiResource('product',ProductController::class);
});







<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('auth/login', [API\AuthController::class,'login']);
Route::post('auth/signup',[API\UserController::class, 'store']);

Route::group(['middleware' => 'apiJwt'], function () {
    Route::get('users',[API\UserController::class, 'index']);
    
});
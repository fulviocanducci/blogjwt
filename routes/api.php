<?php

use App\Http\Controllers\AuthController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/auth', [AuthController::class, 'login']);

Route::middleware(['auth:api'])->group(function () {
    Route::get('product', [ProductController::class, 'index']);
    Route::post('product', [ProductController::class, 'create']);
    Route::get('product/{id}', [ProductController::class, 'show'])->where('id', '[0-9]+');
    Route::put('product/{id}', [ProductController::class, 'update'])->where('id', '[0-9]+');
    Route::delete('product/{id}', [ProductController::class, 'delete'])->where('id', '[0-9]+');
});

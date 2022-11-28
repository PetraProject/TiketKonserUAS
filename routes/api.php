<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TiketController;
use App\Http\Controllers\TransaksiController;

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

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    
    Route::group(['prefix' => 'public'], function () {
        Route::resource('tiket', TiketController::class, ['only' => ['index']]);
        Route::resource('transaksi', TransaksiController::class, ['only' => ['store']]);
    });
    
    Route::group(['prefix' => 'admin'], function () {
        Route::resource('transaksi', TransaksiController::class, ['only' => ['index', 'show', 'store', 'update', 'destroy']]);
        Route::resource('tiket', TiketController::class, ['only' => ['index', 'store', 'update', 'destroy', 'show']]);        
    });
});

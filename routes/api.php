<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\RumahMakanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function () {
    Route::group(['middleware' => ['role:admin|pemilikUsaha|pelanggan']], function () {
        Route::get('rumah-makan/{rumahMakan}/menu', [MenuController::class, 'index']);
        Route::get('rumah-makan/{rumahMakan}/menu/{menu}', [MenuController::class, 'show']);
        Route::get('/rumah-makan', [RumahMakanController::class, 'index']);
        Route::get('/rumah-makan/{rumahMakan}', [RumahMakanController::class, 'show']);
        Route::put('/rumah-makan/{rumahMakan}', [RumahMakanController::class, 'update']);
    });

    Route::group(['middleware' => ['role:pemilikUsaha']], function () {
        Route::post('/menu', [MenuController::class, 'store']);
        Route::put('rumah-makan/{rumahMakan}/menu/{menu}', [MenuController::class, 'update']);
        Route::delete('/menu/{menu}', [MenuController::class, 'destroy']);
    });

    Route::group(['middleware' => ['role:admin']], function () {
        Route::post('/rumah-makan', [RumahMakanController::class, 'store']);
        Route::delete('/rumah-makan/{rumahMakan}', [RumahMakanController::class, 'destroy']);
    });
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

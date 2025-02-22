<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/user-data', [App\Http\Controllers\Auth\AuthController::class, 'userData']);

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('/logout', [App\Http\Controllers\Auth\AuthController::class, 'logout']);


});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

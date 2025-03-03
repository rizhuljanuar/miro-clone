<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/user-data', [App\Http\Controllers\Auth\AuthController::class, 'userData']);

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('/logout', [App\Http\Controllers\Auth\AuthController::class, 'logout']);


    Route::controller(App\Http\Controllers\Project\ProjectController::class)->group(function () {
        Route::get('/projects', 'projects');
        Route::get('/projects/detail', 'projectDetail');
        Route::post('/projects', 'createProject');
        Route::put('/projects', 'updateProject');
    });

    Route::controller(App\Http\Controllers\Project\ProjectBoardController::class)->group(function () {

        Route::post('/mini_text_editors', 'createOrUpdateMiniTextEditor');
        Route::post('/sticky_notes',  'createOrUpdateStickyNote');
        Route::post('/drawings',  'createOrUpdateDrawing');
        Route::post('/text_captions',  'createOrUpdateTextCaption');
        Route::get('/project_boards',  'projectBoardData');
        Route::post('/joinees',  'addJoinees');
    });
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

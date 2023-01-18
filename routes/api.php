<?php

use App\Http\Controllers\Api\ExtendRequestController;
use App\Http\Controllers\Api\HintController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\UserController;
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
Route::group(["prefix" => "auth"], function(){

    Route::post('/register', [UserController::class, 'register'])->name('auth.register');

    Route::post('/login', [UserController::class, 'login'])->name('auth.login');

    Route::middleware('auth:sanctum')->post('/logout', [UserController::class, 'logout'])->name('auth.logout');
});

Route::group(["prefix" => "tasks", "middleware" => 'auth:sanctum'], function(){

    // Request To Get All Tasks
    Route::get('/all', [TaskController::class, 'index'])->name("api.tasks.all");

    // Single Task Operations
    Route::group(["prefix" => "/{task}"], function(){
        Route::post('/confirm', [TaskController::class, 'confirm'])->name('api.task.confirm');
        Route::post('/complete', [TaskController::class, 'complete'])->name('api.task.complete');

        Route::post('/extend', [ExtendRequestController::class, 'store'])->name('api.task.extend');

        Route::post('/open/hint/{hint}', [HintController::class, 'show'])->name('api.task.show.hint');
    });

});




<?php

use App\Http\Controllers\Dashboard\TaskController;
use App\Http\Controllers\Dashboard\HintController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\Auth\LoginController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// To Differ Between Tham and Those With The Api
Route::name('web.')->group(function(){

    // Authentication Routes
    Route::group(["prefix" => "auth"], function(){
        // Login Routes
        Route::get('/login', [LoginController::class, 'login_page'])->name('auth.login.view');
        Route::post("/login", [LoginController::class, "login"])->name('auth.login');

    });

    // Page Routes, User Need To Be Authorized To Do an Action
    Route::group(["middleware" => 'auth'], function(){

        // Homepage Route
        Route::get('/', [TaskController::class, 'current_active'])->name("home");

        // Tasks and Hints Route
        Route::group(['prefix' => '/tasks'], function(){

            // Tasks
            Route::get('/history', [TaskController::class, 'index'])->name('tasks.history');
            Route::get('/create', [TaskController::class, 'create'])->name('tasks.create');
            Route::post('/store', [TaskController::class, 'store'])->name('tasks.store');
            Route::get('/{task}/show', [TaskController::class, 'show'])->name('tasks.show');

            // Hints
            Route::group(['prefix' => '/hints'], function(){
                Route::post('/create', [HintController::class, 'store'])->name('task.hints.create');
                Route::post('/{hint}/delete', [HintController::class, 'destroy'])->name('task.hints.delete');
            });

        });
    });
});

<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Setting\AccountController;
use App\Http\Controllers\Setting\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::pattern('INV', '[A-Z0-9]{12}'); // Filter Parameter INVOICE
Route::pattern('theme', '[a-z]+'); // Filter Parameter INVOICE
Route::pattern('id', '[0-9]+'); // Filter Parameter GET
Route::pattern('detail_id', '[0-9]+'); // Filter Parameter GET
Route::pattern('sub_detail_id', '[0-9]+'); // Filter Parameter GET
Route::pattern('uuid', '[A-Fa-f0-9]{32}$'); // Filter Parameter GET
Route::pattern('date', '[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])'); // Filter Parameter GET

Auth::routes(['register' => false, 'confirm' => false, 'email' => false, 'reset' => false]);
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);
Route::get('/login-sso', [App\Http\Controllers\Auth\LoginController::class, 'showLoginSSO']);
Route::get('/attempt-sso', [App\Http\Controllers\Auth\LoginController::class, 'attemptLoginSSO']);

Route::get('/', [DashboardController::class, 'index'])->middleware('auth');
Route::get('/home', [DashboardController::class, 'index'])->middleware('auth');

// theme
Route::get('/theme/{theme}', [\App\Http\Controllers\Setting\ThemeController::class, 'index']);

Route::group(['prefix' => 'setting', 'middleware' => ['auth']], function(){
    // profile
    Route::get('account', [AccountController::class, 'index']);
    Route::put('account', [AccountController::class, 'update']);
    Route::put('account/avatar', [AccountController::class, 'update_avatar']);
    Route::put('account/password', [AccountController::class, 'update_password']);

    // profile
    Route::get('profile', [ProfileController::class, 'index']);
    Route::put('profile', [ProfileController::class, 'update']);
    Route::put('profile/avatar', [ProfileController::class, 'update_avatar']);
    Route::put('profile/password', [ProfileController::class, 'update_password']);
});
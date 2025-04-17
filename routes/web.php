<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('user.index');
});


Route::get('base', function () {
    return view('basesLayout.base');
});


Route::get('login',[UserController::class, 'login'])->name('user.login');
<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('user.index');
});


Route::get('base', function () {
    return view('basesLayout.base');
});

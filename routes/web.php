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


//adicionar usuario com um usuario já logado, exemplo: administrador pode adicionar um novo usuario de maneira manual no sistema
Route::get('view.user.add.create',[UserController::class, 'view_add_user_create'])->name('view.user.add.create');

Route::get('date_add_new_user',[UserController::class, 'date_add_new_user'])->name('date.user.add.create');
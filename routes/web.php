<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('user.index');
})->name('index');


Route::get('base', function () {
    return view('basesLayout.base');
});

//acessar a view de login, onde o mesmo usa o email e senha pois o laravel trabalha de forma mais eficiente, logo após
//os dados sendo verificados e com o sucesso da verificação o mesmo retorna para a index do sistema já authenticado;
Route::get('view/login',[UserController::class, 'view_login'])->name('view.user.login');

Route::post('login',[UserController::class, 'login'])->name('date.user.login');

//adicionar usuario com um usuario já logado, exemplo: administrador pode adicionar um novo usuario de maneira manual no sistema
Route::get('view/user/add/create',[UserController::class, 'view_add_user_create'])->name('view.user.add.create');

Route::get('date/add/new/user',[UserController::class, 'date_add_new_user'])->name('date.user.add.create');

//listar todos os usuarios

Route::get('list/users',[UserController::class, 'list_users'])->name('list_users');
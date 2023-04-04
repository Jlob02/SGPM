<?php

use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {

    $result = User::all();

    if ($result->isEmpty()) {
        return view('register');
    }
    return view('login');
});

//routes de autentincação login e logout
Route::post('login', [UserController::class, 'login']);

Route::get('login', function () {
    if (Auth::check()) {
        return  redirect('home');
    }
    return view('login');
});

Route::get('logout', [UserController::class, 'logout'])->middleware(['auth']);

//route para registar o administrador 
Route::post('registerAdmin', [UserController::class, 'registerAdmin']);


//groupo de routes para verificar se o utilizar esta autenticado
Route::middleware(['auth'])->group(function () {
    //route para a página inicial
    Route::get('home', function () {
        return view('home');
    });
    Route::get('materia-prima', function () {
        return view('materia-prima');
    });
    Route::get('empresas', function () {
        return view('empresas');
    });
   
    Route::get('funcionarios', [UserController::class, 'funcionarios']);

    Route::get('adicionar-funcionario', function () {
        return view('adicionar-funcionario');
    });

    //route para registar funcionario
    Route::post('registar', [UserController::class, 'registar']);
});

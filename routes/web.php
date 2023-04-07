<?php

use App\Http\Controllers\EmpresaController;
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
        return view('registar-admin');
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
Route::post('registar-admin', [UserController::class, 'registar_admin']);


//groupo de routes para verificar se o utilizar esta autenticado
Route::middleware(['auth'])->group(function () {
    //route para a página inicial
    Route::get('home', function () {
        return view('home');
    });

    Route::get('materia-prima', function () {
        return view('materia-prima');
    });

    

    //routes para os funcionários
    Route::get('funcionarios', [UserController::class, 'funcionarios']);

    Route::delete('funcionarios/{id}/apagar', [UserController::class, 'apagar_funcionario']);

    Route::post('funcionarios/{id}/{estado}', [UserController::class, 'alterar_estado_funcionario']);

    //route para registar funcionario
    Route::post('registar', [UserController::class, 'registar']);

    Route::get('adicionar-funcionario', function () {
        return view('adicionar-funcionario');
    });

    Route::get('funcionarios/alterar/{id}', [UserController::class, 'dados_funcionario']);

    Route::post('alterar-funcionario/{id}', [UserController::class, 'alterar_funcionario']);

    
    //routes para empresas

    Route::get('empresas', [EmpresaController::class, 'empresas']);

    Route::get('adicionar-empresa', function () {
        return view('adicionar-empresa');
    });

    Route::delete('empresas/{id}/apagar', [EmpresaController::class, 'apagar_empresa']);

    Route::post('empresas/{id}/{estado}', [EmpresaController::class, 'alterar_estado_empresa']);

    //route para registar empresa
    Route::post('registar-empresa', [EmpresaController::class, 'registar_empresa']);

    Route::post('alterar-empresa/{id}', [EmpresaController::class, 'alterar_empresa']);

    Route::get('empresas/alterar/{id}', [EmpresaController::class, 'dados_empresa']);
});

<?php

use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\FornecedorController;
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
    if (Auth::check()) {
        return  redirect('home');
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

//route para recuperar a palavra-passe
Route::get('recuperar-password', function () {
    if (Auth::check()) {
        return  redirect('home');
    }
    return view('recuperar-password');
});

//groupo de routes para verificar se o utilizar esta autenticado
Route::middleware(['auth'])->group(function () {
    //route para a página inicial
    Route::get('home', function () {
        return view('home');
    });

    Route::get('materia-prima', function () {
        return view('materia-prima');
    });

    Route::get('perfil', [UserController::class, 'perfil']);

    //routes para os funcionários
    Route::get('funcionarios', [UserController::class, 'funcionarios']);

    Route::delete('funcionarios/apagar/{id}', [UserController::class, 'apagar_funcionario']);

    Route::post('funcionarios/alterar/{id}/{estado}', [UserController::class, 'alterar_estado_funcionario']);

    //route para adicionar funcionario
    Route::post('funcionarios/adicionar', [UserController::class, 'registar']);

    Route::get('funcionarios/adicionar', [UserController::class, 'veiw_adicionar_funcionario']);


    Route::get('funcionarios/alterar/{id}', [UserController::class, 'dados_funcionario']);

    Route::post('funcionarios/alterar/{id}', [UserController::class, 'alterar_funcionario']);

    Route::post('adicionar-funcao', [UserController::class, 'adicionar_funcao']);

    
    //routes para empresas

    Route::get('empresas', [EmpresaController::class, 'empresas']);

    Route::delete('empresas/apagar/{id}', [EmpresaController::class, 'apagar_empresa']);

    Route::post('empresas/alterar/{id}/{estado}', [EmpresaController::class, 'alterar_estado_empresa']);

    //route para registar empresa
    Route::post('empresas/adicionar', [EmpresaController::class, 'registar_empresa']);

    Route::get('empresas/adicionar', function () {
        return view('adicionar-empresa');
    });

    Route::post('empresas/alterar/{id}', [EmpresaController::class, 'alterar_empresa']);

    Route::get('empresas/alterar/{id}', [EmpresaController::class, 'dados_empresa']);


    //routes para fornecedores
    Route::get('fornecedores', [FornecedorController::class, 'fornecedores']);

    Route::delete('fornecedores/apagar/{id}', [FornecedorController::class, 'apagar_fornecedor']);

    Route::get('fornecedores/adicionar', function () {
        return view('adicionar-fornecedor');
    });

    Route::post('fornecedores/adicionar', [FornecedorController::class, 'registar']);

    Route::get('fornecedores/alterar/{id}', [FornecedorController::class, 'dados_fornecedor']);

    Route::post('fornecedores/alterar/{id}', [FornecedorController::class, 'alterar_fornecedor']);

});

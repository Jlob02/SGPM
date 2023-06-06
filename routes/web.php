<?php

use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\PrecoController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\MateriaPrimaController;
use App\Http\Controllers\RecuperarPasswordController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ForumController;
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

    return redirect('login');
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


//routes para recuperar a password
Route::post('/recuperar/password', [RecuperarPasswordController::class, 'recuperar_password']);

Route::get('/recuperar/password/{token}', [RecuperarPasswordController::class, 'recuperar_password_token']);

Route::post('/redefinir/password/{token}', [RecuperarPasswordController::class, 'redefinir_password']);

//groupo de routes para verificar se o utilizar esta autenticado
Route::middleware(['auth'])->group(function () {

    //route para a página inicial
    Route::get('home', [PrecoController::class, 'precos']);

    Route::get('perfil', [UserController::class, 'perfil']);


    //groupo de routes para verificar se o utilizar é administrador e administrador de empresa
    Route::middleware(['permission.admin.empresa'])->group(function () {

        //routes para os funcionários
        Route::get('funcionarios', [UserController::class, 'funcionarios']);

        Route::delete('funcionarios/apagar/{id}', [UserController::class, 'apagar_funcionario']);

        Route::post('funcionarios/alterar/{id}/{estado}', [UserController::class, 'alterar_estado_funcionario']);

        Route::post('funcionarios/adicionar', [UserController::class, 'registar']);

        Route::get('funcionarios/adicionar', [UserController::class, 'veiw_adicionar_funcionario']);

        Route::get('funcionarios/alterar/{id}', [UserController::class, 'dados_funcionario']);

        Route::post('funcionarios/alterar/{id}', [UserController::class, 'alterar_funcionario']);

        Route::post('funcionarios/adicionar/funcao', [UserController::class, 'adicionar_funcao']);
    });

    //groupo de routes para verificar se o utilizar é administrador 
    Route::middleware(['permission.admin'])->group(function () {

        //routes para empresas -------------------------

        Route::get('empresas', [EmpresaController::class, 'empresas']);

        Route::delete('empresas/apagar/{id}', [EmpresaController::class, 'apagar_empresa']);

        Route::post('empresas/alterar/{id}/{estado}', [EmpresaController::class, 'alterar_estado_empresa']);

        Route::post('empresas/adicionar', [EmpresaController::class, 'registar_empresa']);

        Route::get('empresas/adicionar', function () {
            return view('adicionar-empresa');
        });

        Route::post('empresas/alterar/{id}', [EmpresaController::class, 'alterar_empresa']);

        Route::get('empresas/alterar/{id}', [EmpresaController::class, 'dados_empresa']);

        //fim routes para empresas ------------------------

    });

    //route para matéria-prima ------------------------
    Route::get('materia-prima', [MateriaPrimaController::class, 'materias_primas']);

    Route::post('materia-prima/adicionar', [MateriaPrimaController::class, 'registar']);

    Route::get('materia-prima/adicionar', [MateriaPrimaController::class, 'veiw_adicionar_materia_prima']);

    Route::delete('materia-prima/apagar/{id}', [MateriaPrimaController::class, 'apagar_materia_prima']);

    Route::post('materia-prima/alterar/{id}', [MateriaPrimaController::class, 'alterar_materia_prima']);

    Route::get('materia-prima/alterar/{id}', [MateriaPrimaController::class, 'dados_materia_prima']);

    Route::post('materia-prima/preco/{id}', [PrecoController::class, 'registar_preco']);

    Route::post('materia-prima/alerta/{id}', [MateriaPrimaController::class, 'registar_alerta']);

    Route::delete('materia-prima/preco/apagar/{id}', [PrecoController::class, 'apagar_preco']);

    Route::get('materia-prima/precos', [PrecoController::class, 'precos_materias_primas']);

    Route::post('materia-prima/adicionar/familia', [MateriaPrimaController::class, 'adicionar_familia']);

    Route::post('materia-prima/adicionar/subfamilia', [MateriaPrimaController::class, 'adicionar_subfamilia']);

    Route::post('materia-prima/adicionar/codigo', [MateriaPrimaController::class, 'adicionar_codigo']);

    Route::get('materia-prima/{codigo}', [MateriaPrimaController::class, 'precos_materias_primas']);

    //fim route para matéria-prima -------------------------


    //routes para fornecedores------------------------------
    Route::get('fornecedores', [FornecedorController::class, 'fornecedores']);

    Route::delete('fornecedores/apagar/{id}', [FornecedorController::class, 'apagar_fornecedor']);

    Route::get('fornecedores/adicionar', function () {
        return view('adicionar-fornecedor');
    });

    Route::post('fornecedores/adicionar', [FornecedorController::class, 'registar']);

    Route::get('fornecedores/alterar/{id}', [FornecedorController::class, 'dados_fornecedor']);

    Route::post('fornecedores/alterar/{id}', [FornecedorController::class, 'alterar_fornecedor']);

    //fim routes para fornecedores------------------------------


    //routes para fórum------------------------------
    Route::get('forum', [ForumController::class, 'topicos']);

    Route::get('forum/novo-topico', [ForumController::class, 'novo_topico']);

    Route::post('forum/novo-topico', [ForumController::class, 'registar_topico']);

    Route::post('forum/topico/{id}', [ForumController::class, 'registar_comentario']);

    Route::get('forum/topico/{id}', [ForumController::class, 'topico']);

    Route::get('forum/topicos/{id}', [ForumController::class, 'topicos_categoria']);

    //fim routes para fórum------------------------------

});

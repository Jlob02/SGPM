<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Funcao;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //função para fazer o login
    public function login(Request $request)
    {
        $credentials = $request->validate(
            [
                'email' => 'required|email|max:255',
                'password' => 'required',
            ],
            [
                'email.required' => 'Tem que introduzir um email',
                'email.email' => 'Email inválido',
                'password.required' => ' Tem que introduzir uma password'
            ]
        );
        //implementa o remember-me
        $remember_me = $request->has('remember_me') ? true : false;

        //verifica as credenciais e tenta fazer o login
        if (Auth::attempt($credentials, $remember_me)) {
            $user = User::where('email', $request->email)->first();

            Auth::login($user);
            $request->session()->regenerate();

            return redirect('/home');
        } else {
            return back()->withErrors(['erro' => 'Email ou password inválidos']);
        }
    }
    //função para fazer o logout do utilizador

    public function logout(Request $request)
    {

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerate();

        return redirect('/');
    }

    //função para registar adiministrador 
    public function registar_admin(Request $request)
    {

        $data = $request->validate([
            'nome' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8']
        ], [
            'nome.required' => 'Deve introduzir um nome',
            'email.required' => 'Deve introduzir um email',
            'email.unique' => 'Ja existe uma conta associada a este email',
            'password.required' => 'Deve introduzir uma password',
            'emali.email' => 'Deve introduzir um email válido',
        ]);

        $user = new User();
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->u_nome = $data['nome'];
        $user->u_tipo = 1;
        $user->funcao_id = 1;
        $user->u_estado = 1;
        $user->u_contacto = 910000000;

        $user->save();

        return redirect('/')->with('Sucesso', 'Utilizador registado com sucesso');
    }


    //função para registar funcionario 
    public function registar(Request $request)
    {
        $data = $request->validate([
            'nome' => ['required'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8'],
            'funcao' => ['required'],
            'tipo' => ['required'],
            'empresa' => ['required'],
            'contacto' => ['required', 'max:9'],
        ], [
            'nome.required' => 'Deve introduzir o nome do funcionário',
            'email.required' => 'Deve introduzir o email do funcionário',
            'email.unique' => 'Ja existe um funcionário com conta associada a este email',
            'password.required' => 'Deve introduzir uma password',
            'emali.email' => 'Deve introduzir um email válido',
            'empresa.required' => 'Deve selecionar um empresa',
        ]);

        $user = new User();
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->u_nome = $data['nome'];
        $user->u_tipo = $data['tipo'];
        $user->funcao_id = $data['funcao'];
        $user->empresa_id = $data['empresa'];
        $user->u_estado = 1;
        $user->u_contacto = $data['contacto'];

        $user->save();

        return  redirect()->back()->with('success', 'Utilizador registado com sucesso');
    }


    //função para alterar um funcionario 
    public function alterar_funcionario(Request $request)
    {
        $data = $request->validate([
            'nome' => ['required'],
            'email' => ['required', 'email', "unique:users,email,$request->id"],
            'funcao' => ['required'],
            'tipo' => ['required'],
            'empresa' => ['required'],
            'contacto' => ['required', 'max:9'],
        ], 
        [
            'nome.required' => 'Deve introduzir o nome do funcionário',
            'email.required' => 'Deve introduzir o email do funcionário',
            'email.unique' => 'Ja existe um funcionário com conta associada a este email',
            'password.required' => 'Deve introduzir uma password',
            'emali.email' => 'Deve introduzir um email válido',
            'empresa.required' => 'Deve selecionar um empresa',
        ]);

        $user = User::where('id', '=', $request->id)->first();
        $user->email = $data['email'];

        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        $user->u_nome = $data['nome'];
        $user->u_tipo = $data['tipo'];
        $user->funcao_id = $data['funcao'];
        $user->empresa_id = $data['empresa'];
        $user->u_contacto = $data['contacto'];

        $user->save();

        return  redirect('/funcionarios')->with('success', 'Utilizador alterado com sucesso');
    }

    //funcao para retornar todos funcionários
    public function funcionarios(Request $request)
    {

        $search = $request->input('search');


        if (!empty($search)) {
            $users = User::with('funcao','empresa')->where('u_nome', 'LIKE', "%{$search}%")->sortable()->paginate(15);
        } else {
            $users = User::with('funcao','empresa')->sortable()->paginate(15);
        }

        return view('funcionarios')->with('users', $users);
    }

    //função para apagar um funcionário

    public function apagar_funcionario(Request $request)
    {
        if (Auth::user()->u_tipo == 1) {
            $user = User::where('id', '=', $request->id)->first();
        }

        $user->delete();
        return  redirect()->back()->with('success', 'Utilizador apagado com sucesso');
    }

    //função para alterar o estado do funcionário

    public function alterar_estado_funcionario(Request $request)
    {

        if (Auth::user()->u_tipo == 1) {
            $user = User::where('id', '=', $request->id)->first();
        }

        if ($request->estado == 1) {
            $user->u_estado = 0;
        } else {
            $user->u_estado = 1;
        }

        $user->save();
        return  redirect()->back()->with('success', 'Estado alterado com sucesso');
    }


    //função para retornar os dados do funcionário
    public function dados_funcionario(Request $request)
    {

        if (Auth::user()->u_tipo == 1) {
            $user = User::where('id', '=', $request->id)->first();
        }
        return view('alterar-funcionario')->with('user', $user);
    }

    //função para registar funcionario 
    public function adicionar_funcao(Request $request)
    {
        $data = $request->validate([
            'funcao' => ['required', 'unique:funcao'],
        ], [
            'funcao.required' => 'Deve introduzir uma função',
            'email.unique' => 'Esta função já foi registada',
        ]);

        $funcao = new Funcao();
        $funcao->funcao = $data['funcao'];

        $funcao->save();

        return  redirect()->back()->with('success', 'Função registada com sucesso');
    }
   

    //função para retornar a view adicionar funcionario 
    public function  veiw_adicionar_funcionario(Request $request)
    {
        $funcoes = Funcao::all();
        $empresas = Empresa::all();

        return  view('adicionar-funcionario')->with('funcoes', $funcoes)->with('empresas',$empresas);
    }

    //função para retornar o perfil do utilizador
    public function  perfil(Request $request)
    {
        $user = User::where('id', '=', Auth::user()->id)->first();
        return  view('perfil')->with('user',$user);
    }
}

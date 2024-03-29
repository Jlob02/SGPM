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

            $empresa = Empresa::where('id', '=', auth()->user()->empresa_id)->first();

            if (auth()->user()->u_estado == 0 or $empresa->estado == 0) {
                auth()->logout();
                return back()->withErrors(['erro' => 'Utilizador inativo']);
            }

            $user = User::where('email', $request->email)->first();

            Auth::login($user);
            $request->session()->regenerate();

            return redirect('/home');
        }

        return back()->withErrors(['erro' => 'Email ou password inválidos']);
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

        $funcao = new Funcao();
        $funcao->funcao = "Administrador";
        $funcao->save();

        $empresa = new Empresa();
        $empresa->email = 'admin@empresa.com';
        $empresa->nome = 'DIN';
        $empresa->contacto = '910000000';
        $empresa->nome_responsavel = 'admin admin';
        $empresa->estado = 1;
        $empresa->localidade = 'Coimbra';
        $empresa->pais = 'Portugal';
        $empresa->save();

        $user = new User();
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->u_nome = $data['nome'];
        $user->empresa_id = 1;
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
            'password.min:8' => 'A password deve ter mais de 8 caracteres',
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
        $data = $request->validate(
            [
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
            ]
        );

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


    //função para alterar um funcionario 
    public function alterar_perfil(Request $request)
    {
        $data = $request->validate(
            [
                'nome' => ['required'],
                'email' => ['required', 'email', "unique:users,email,$request->id"],
                'contacto' => ['required', 'max:9'],

            ],
            [
                'nome.required' => 'Deve introduzir o nome do funcionário',
                'email.required' => 'Deve introduzir o email do funcionário',
                'email.unique' => 'Ja existe um funcionário com conta associada a este email',
                'emali.email' => 'Deve introduzir um email válido',
            ]
        );

        $user = User::where('id', '=',  Auth::user()->id)->first();
        $user->email = $data['email'];

        if (!empty($request->password)) {

            $data1 = $request->validate(
                [
                    'password' => ['required', 'min:8'],
                    'new_password' => ['required', 'min:8'],
                ],
                []
            );

            if (Hash::check($data1['password'], $user->password)) {
                $user->password = Hash::make($data1['new_password']);
            } else {
                return  redirect('/perfil')->with('error', 'Password inválida');
            }
        }

        $user->u_nome = $data['nome'];
        $user->email = $data['email'];
        $user->u_contacto = $data['contacto'];

        $user->save();

        return  redirect('/perfil')->with('success', 'Utilizador alterado com sucesso');
    }

    //funcao para retornar todos funcionários
    public function funcionarios(Request $request)
    {
        $search = $request->input('search');

        if (!empty($search)) {
            if (Auth::User()->u_tipo == 1)
                $users = User::with('funcao', 'empresa')->where('u_nome', 'LIKE', "%{$search}%")->sortable()->paginate(15);
            else
                $users = User::with('funcao', 'empresa')->where('u_nome', 'LIKE', "%{$search}%")->sortable()->paginate(15);
        } else {
            if (Auth::User()->u_tipo == 1)
                $users = User::with('funcao', 'empresa')->sortable()->paginate(15);
            else
                $users = User::with('funcao', 'empresa')->where('empresa_id', '=', Auth::User()->empresa_id)->sortable()->paginate(15);
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
        $funcoes = Funcao::all();
        $empresas = Empresa::all();

        if (Auth::user()->u_tipo == 1) {
            $user = User::with('funcao', 'empresa')->where('id', '=', $request->id)->first();
        }
        return view('alterar-funcionario')->with('user', $user)->with('funcoes', $funcoes)->with('empresas', $empresas);
    }

    //função para retornar os dados do funcionário
    public function dados_perfil(Request $request)
    {
        $funcoes = Funcao::all();
        $empresas = Empresa::all();

        $user = User::with('funcao', 'empresa')->where('id', '=', Auth::user()->id)->first();

        return view('perfil-alterar-funcionario')->with('user', $user)->with('funcoes', $funcoes)->with('empresas', $empresas);
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

        return  view('adicionar-funcionario')->with('funcoes', $funcoes)->with('empresas', $empresas);
    }

    //função para retornar o perfil do utilizador
    public function  perfil(Request $request)
    {
        $user = User::with('funcao', 'empresa')->where('id', '=', Auth::user()->id)->first();
        return  view('perfil')->with('user', $user);
    }
}

<?php

namespace App\Http\Controllers;

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
        if (Auth::attempt($credentials, $remember_me )) {
            $user = User::where('email', $request->email)->first();

            Auth::login($user);
            $request->session()->regenerate();

            return redirect('/home');

        } else {
            return back()->withErrors(['erro' => 'Email ou password inválidos']);
        }

    }
    //função para fazer o logout do utilizador

    public function logout(Request $request){

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
            'password'=> ['required', 'min:8']
        ],[
            'nome.required'=> 'Deve introduzir um nome',
            'email.required'=> 'Deve introduzir um email',
            'email.unique'=> 'Ja existe uma conta associada a este email',
            'password.required'=> 'Deve introduzir uma password',
            'emali.email'=> 'Deve introduzir um email válido',
        ]);

        $user = new User();
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->u_nome = $data['nome'];
        $user->u_tipo = 1;
        $user->u_funcao = 1;
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
            'password'=> ['required', 'min:8'],
            'funcao' => ['required'],
            'tipo' => ['required'],
            'empresa' => ['required'],
            'contacto' => ['required'],
        ],[
            'nome.required'=> 'Deve introduzir o nome do funcionário',
            'email.required'=> 'Deve introduzir o email do funcionário',
            'email.unique'=> 'Ja existe um funcionário com conta associada a este email',
            'password.required'=> 'Deve introduzir uma password',
            'emali.email'=> 'Deve introduzir um email válido',
        ]);

        $user = new User();
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->u_nome = $data['nome'];
        $user->u_tipo = $data['tipo'];
        $user->u_funcao = $data['funcao'];
        $user->empresa_id = $data['empresa'];
        $user->u_estado = 1;
        $user->u_contacto = $data['contacto'];

        $user->save();

        return  redirect()->back()->with('success', 'Utilizador registado com sucesso');

    }

    public function funcionarios(Request $request){

        $users = User::sortable()->paginate(15);

        return view('funcionarios')->with('users',$users);
    }
}
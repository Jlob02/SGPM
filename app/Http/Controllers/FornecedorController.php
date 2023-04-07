<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class FornecedorController extends Controller
{

    //função para registar funcionario 
    public function registar(Request $request)
    {
        $data = $request->validate([

            'nome' => ['required'],
            'email' => ['required', 'email', 'unique:fornecedores'],
            'contacto' => ['required', 'max:9']
        ], [
            'nome.required' => 'Deve introduzir o nome do fornecedor',
            'email.required' => 'Deve introduzir o email do fornecedor',
            'email.unique' => 'Ja existe um fornecedor com este email',
            'email.email' => 'Deve introduzir um email válido',
            'contacto.required' => 'Deve introduzir o contacto do fornecedor',
        ]);

        $fornecedor = new Fornecedor();
        $fornecedor->nome = $data['nome'];
        $fornecedor->email = $data['email'];
        $fornecedor->contacto = $data['contacto'];
        $fornecedor->empresa = Auth::User()->empresa_id;

        $fornecedor->save();

        return  redirect()->back()->with('success', 'Fornecedor registado com sucesso');
    }

    //funcao para retornar todos funcionários
    public function fornecedores(Request $request)
    {
        $search = $request->input('search');

        if (!empty($search)) {
            $fornecedores = Fornecedor::query()->where('nome', 'LIKE', "%{$search}%")->sortable()->paginate(15);
        } else {
            $fornecedores = Fornecedor::query()->where('empresa', '=', Auth::User()->empresa_id)->sortable()->paginate(15);
        }

        return view('fornecedores')->with('fornecedores', $fornecedores);
    }

    //função para apagar um fornecedor

    public function apagar_fornecedor(Request $request)
    {
        $fornecedor = Fornecedor::where('id', '=', $request->id , 'AND', 'empresa', '=', Auth::User()->empresa_id )->first();

        if ( $fornecedor != null) {
            $fornecedor->delete();
            return  redirect()->back()->with('success', 'Fornecedor apagado com sucesso');
        }
        return  redirect()->back()->with('error', 'Não foi possivel apagar o fornecedor');
    }
}

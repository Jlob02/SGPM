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

            'nome' => ['required', 'unique:fornecedores'],
            'pessoa_contacto' => ['required'],
            'email' => ['required', 'email', 'unique:fornecedores'],
            'contacto' => ['required', 'max:9'],
            'pais' => ['required'],
        ], [
            'nome.required' => 'Deve introduzir o nome do fornecedor',
            'nome.unique' => 'Já existe um fornecedor com este nome',
            'email.required' => 'Deve introduzir o email do fornecedor',
            'email.unique' => 'Já existe um fornecedor com este email',
            'email.email' => 'Deve introduzir um email válido',
            'contacto.required' => 'Deve introduzir o contacto do fornecedor',
            'pais.required' => 'Deve introduzir o pais do fornecedor',
        ]);

        $fornecedor = new Fornecedor();
        $fornecedor->nome = $data['nome'];
        $fornecedor->email = $data['email'];
        $fornecedor->contacto = $data['contacto'];
        $fornecedor->pessoa_contacto = $data['pessoa_contacto'];
        $fornecedor->pais = $data['pais'];
        $fornecedor->empresa_id = Auth::User()->empresa_id;

        $fornecedor->save();

        return  redirect()->back()->with('success', 'Fornecedor registado com sucesso');
    }

    //função para registar funcionario 
    public function alterar_fornecedor(Request $request)
    {
        $data = $request->validate([

            'nome' => ['required', "unique:fornecedores,nome,$request->id"],
            'pessoa_contacto' => ['required'],
            'email' => ['required', 'email', "unique:fornecedores,email,$request->id"],
            'contacto' => ['required', 'max:9'],
            'pais' => ['required'],
        ], [
            'nome.required' => 'Deve introduzir o nome do fornecedor',
            'nome.unique' => 'Já existe um fornecedor com este nome',
            'email.required' => 'Deve introduzir o email do fornecedor',
            'email.unique' => 'Já existe um fornecedor com este email',
            'email.email' => 'Deve introduzir um email válido',
            'contacto.required' => 'Deve introduzir o contacto do fornecedor',
            'pais.required' => 'Deve introduzir o pais do fornecedor',
        ]);

        $fornecedor = Fornecedor::where('id', '=', $request->id, 'AND', 'empresa_id', '=', Auth::User()->empresa_id)->first();
        $fornecedor->nome = $data['nome'];
        $fornecedor->email = $data['email'];
        $fornecedor->pais = $data['pais'];
        $fornecedor->contacto = $data['contacto'];
        $fornecedor->pessoa_contacto = $data['pessoa_contacto'];
        $fornecedor->save();

        return  redirect('/fornecedores')->with('success', 'Fornecedor alterado com sucesso');
    }

    //funcao para retornar todos funcionários
    public function fornecedores(Request $request)
    {
        $search = $request->input('search');

        if (!empty($search)) {
            if (Auth::User()->u_tipo == 1)
                $fornecedores = Fornecedor::query()->where('nome', 'LIKE', "%{$search}%")->sortable()->paginate(15);
            else
                $fornecedores = Fornecedor::query()->where('nome', 'LIKE', "%{$search}%", 'AND', 'empresa_id', '=', Auth::User()->empresa_id)->sortable()->paginate(15);
        } else {
            if (Auth::User()->u_tipo == 1)
                $fornecedores = Fornecedor::query()->sortable()->paginate(15);
            else
                $fornecedores = Fornecedor::query()->where('empresa_id', '=', Auth::User()->empresa_id)->sortable()->paginate(15);
        }

        return view('fornecedores')->with('fornecedores', $fornecedores);
    }

    //função para apagar um fornecedor

    public function apagar_fornecedor(Request $request)
    {
        $fornecedor = Fornecedor::where('id', '=', $request->id, 'AND', 'empresa_id', '=', Auth::User()->empresa_id)->first();

        if ($fornecedor != null) {
            $fornecedor->delete();
            return  redirect()->back()->with('success', 'Fornecedor apagado com sucesso');
        }
        return  redirect()->back()->with('error', 'Não foi possivel apagar o fornecedor');
    }


    //função para retornar os dados do fornecedor
    public function dados_fornecedor(Request $request)
    {
        if (Auth::user()->u_tipo == 1) {
            $fornecedor = Fornecedor::where('id', '=', $request->id)->first();
        }
        return view('alterar-fornecedor')->with('fornecedor', $fornecedor);
    }
}

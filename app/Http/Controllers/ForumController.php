<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use App\Models\Topico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ForumController extends Controller
{

    //função para registar topico
    public function registar_topico(Request $request)
    {
        $data = $request->validate([

            'titulo' => ['required'],
            'descricao' => ['required', 'max:255'],
            'familia_id' => ['required'],
        ], [
            'titulo.required' => 'Deve introduzir um titulo',
            'descricao.required' => 'Deve introduzir uma descricção',
            'familia_id.required' => 'Deve selecionar uma família de matéria-prima',
        ]);

        $topico = new Topico();
        $topico->titulo = $data['titulo'];
        $topico->descricao = $data['descricao'];
        $topico->data_hora = now();
        $topico->user_id = Auth::User()->id;
        $topico->familia_id = $request->id;
        $topico->save();

        return  redirect()->back()->with('success', 'Tópico registado com sucesso');
    }

    //função para registar funcionario 
    public function alterar_fornecedor(Request $request)
    {
        $data = $request->validate([

            'nome' => ['required', "unique:fornecedores,nome,$request->id"],
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
        $fornecedor->save();

        return  redirect('/fornecedores')->with('success', 'Fornecedor alterado com sucesso');
    }

    //funcao para retornar todos topicos
    public function topicos(Request $request)
    {
        $search = $request->input('search');

        if (!empty($search)) {
            $topicos = Topico::query()->where('titulo', 'LIKE', "%{$search}%", 'OR', 'descricao', 'LIKE', "%{$search}%" )->orderBy('created_at', 'desc')->sortable()->paginate(15);
        } else {
            $topicos = Topico::query()->orderBy('created_at', 'desc')->sortable()->paginate(15);
        }

        return view('forum')->with('topicos', $topicos);
    }



    //função para apagar tópico
    public function apagar_topico(Request $request)
    {
        $topico = Topico::where('id', '=', $request->id, 'AND', 'user_id', '=', Auth::User()->id)->first();

        if ($topico != null) {
            $topico->delete();
            return  redirect()->back()->with('success', 'Tópico apagado com sucesso');
        }
        return  redirect()->back()->with('error', 'Não foi possivel apagar o tópico');
    }


    //retorna os dados de um tópico
    public function topico(Request $request)
    {
        $topico = Topico::where('id', '=', $request->id)->first();

        return view('topico')->with('topico', $topico);
    }
}

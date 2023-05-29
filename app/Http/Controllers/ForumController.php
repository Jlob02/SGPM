<?php

namespace App\Http\Controllers;

use App\Models\Familia;
use App\Models\Comentario;
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
            'familia' => ['required'],
        ], [
            'titulo.required' => 'Deve introduzir um titulo',
            'descricao.required' => 'Deve introduzir uma descricção',
            'familia.required' => 'Deve selecionar uma família de matéria-prima',
        ]);

        $topico = new Topico();
        $topico->titulo = $data['titulo'];
        $topico->descricao = $data['descricao'];
        $topico->data_hora = now();
        $topico->user_id = Auth::User()->id;
        $topico->familia_id = $data['familia'];
        $topico->save();

        return  redirect('/forum')->with('success', 'Tópico registado com sucesso');
    }


    //função para registar comentario
    public function registar_comentario(Request $request)
    {
        $data = $request->validate([
            'comentario' => ['required', 'max:255'],
        ], [
            'comentario.required' => 'Deve introduzir um comentario',
        ]);

        $comentario = new Comentario();
        $comentario->comentario = $data['comentario'];
        $comentario->data_hora = now();
        $comentario->user_id = Auth::User()->id;
        $comentario->topico_id = $request->id;
        $comentario->save();

        return  redirect()->back();
    }


    //funcao para retornar todos topicos
    public function topicos(Request $request)
    {
        $search = $request->input('search');

        if (!empty($search)) {
            $topicos = Topico::query()->where('titulo', 'LIKE', "%{$search}%", 'or', 'descricao', 'LIKE', "%{$search}%")->orderBy('created_at', 'desc')->sortable()->paginate(15);
        } else {
            $topicos = Topico::query()->orderBy('created_at', 'desc')->sortable()->paginate(10);
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

    //retorna a view novo topico
    public function novo_topico(Request $request)
    {
        $familas = Familia::all();
        return view('novo-topico')->with('familias', $familas);
    }


    //retorna os dados de um tópico
    public function topico(Request $request)
    {
        $topico = Topico::where('id', '=', $request->id)->first();
        $comentarios = Comentario::where('topico_id', '=', $request->id)->get();

        return view('topico')->with('topico', $topico)->with('comentarios', $comentarios);
    }
}

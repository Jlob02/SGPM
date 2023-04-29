<?php

namespace App\Http\Controllers;

use App\Models\Familia;
use App\Models\Fornecedor;
use App\Models\Preco;
use App\Http\Requests\StoreMateriaPrimaRequest;
use App\Http\Requests\UpdateMateriaPrimaRequest;
use App\Models\SubFamilia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrecoController extends Controller
{
    //função para registar matéria-prima 
    public function registar_preco(Request $request)
    {
        $data = $request->validate(
            [
                'preco' => ['required'],
                'unidade' => ['required'],
                'fornecedor' => ['required'],
                'data_inicio' => ['required'],
                'data_fim' => ['required'],
            ],
            [
                'preco.required' => 'Deve introduzir o preço da matéria-prima',
                'unidade.required' => 'Deve selecionar a unidade da matéria-prima',
                'data_inicio.required' => 'Deve introduzir a data de inicio',
                'data_fim.unique' => 'Já existe uma matéria-prima com este código',
            ]
        );

        $preco = new Preco();
        $preco->preco = $data['preco'];
        $preco->unidade = $data['unidade'];
        $preco->fornecedor_id = $data['fornecedor'];
        $preco->data_inicio = $data['data_inicio'];
        $preco->data_fim = $data['data_fim'];
        $preco->empresa_id = Auth::User()->empresa_id;
        $preco->materia_prima_id = $request->id;
        
        $preco->save();

        return  redirect()->back()->with('success', 'Preço registado com sucesso');
    }

    

    //funcao para retornar todas preços de matérias-primas de uma empresa
    public function precos_materias_primas(Request $request)
    {
        $search = $request->input('search');

        if (!empty($search)) {
            $precos = Preco::query()->where('desgnacao', 'LIKE', "%{$search}%")->sortable()->paginate(15);
        } else {
            $precos = Preco::query()->where('empresa_id', '=', Auth::User()->empresa_id)->sortable()->paginate(15);
        }

        $fornecedores = Fornecedor::all();
        $subfamila = SubFamilia::all();
        $famila = Familia::all();


        return view('materia-prima')->with('precos', $precos)->with( 'fornecedores', $fornecedores )->with('subfamilias', $subfamila)->with('familias',$famila);
    }

    //funcao para retornar todas preços de matérias-primas 
    public function precos(Request $request)
    {
        $search = $request->input('search');

        if (!empty($search)) {
            $precos = Preco::query()->where('desgnacao', 'LIKE', "%{$search}%")->sortable()->paginate(15);
        } else {
            $precos = Preco::query()->sortable()->paginate(15);
        }

        return view('home')->with('precos', $precos);
    }

    //função para apagar uma matéria-prima 

    public function apagar_preco(Request $request)
    {
        $preco = Preco::where('id', '=', $request->id, 'AND', 'empresa_id', '=', Auth::User()->empresa_id)->first();

        if ($preco != null) {
            $preco->delete();
            return  redirect()->back()->with('success', 'Preço apagado com sucesso');
        }
        return  redirect()->back()->with('error', 'Não foi possivel apagar o preço');
    }


    //função para retornar os dados da matéria-prima 
    public function dados_materia_prima(Request $request)
    {
        $preco = Preco::where('id', '=', $request->id)->first();

        return view('alterar-materia-prima')->with('materia_prima',$preco);
    }
}

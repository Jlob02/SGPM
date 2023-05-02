<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Familia;
use App\Models\Fornecedor;
use App\Models\Preco;
use App\Models\MateriaPrima;
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
                'fornecedor' => ['required', 'integer'],
                'data_inicio' => ['required'],
                'data_fim' => ['required'],
            ],
            [
                'preco.required' => 'Deve introduzir o preço da matéria-prima',
                'unidade.required' => 'Deve selecionar a unidade da matéria-prima',
                'data_inicio.required' => 'Deve introduzir a data de inicio',
                'data_fim.unique' => 'Já existe uma matéria-prima com este código',
                'fornecedor.integer' => 'Deve selecionar um fornecedor',
            ]
        );

        $preco = new Preco();
        $preco->preco = $data['preco'];
        $preco->unidade = $data['unidade'];
        $preco->fornecedor_id = $data['fornecedor'];
        $preco->data_inicio = $data['data_inicio'];
        $preco->data_fim = $data['data_fim'];
        $preco->empresa_id = Auth::User()->empresa_id;
        $preco->materiaprima_id = $request->id;

        $preco->save();

        return  redirect()->back()->with('success', 'Preço registado com sucesso');
    }



    //funcao para retornar todas preços de matérias-primas de uma empresa
    public function precos_materias_primas(Request $request)
    {
        $search = $request->input('search');

        if (!empty($search)) {
            $precos = Preco::with('materiaprima', 'fornecedor')->where('designacao', 'LIKE', "%{$search}%")->sortable()->paginate(15);
        } else {
            $precos = Preco::with('materiaprima', 'fornecedor')->where('empresa_id', '=', Auth::User()->empresa_id)->sortable()->paginate(15);
        }

        $fornecedores = Fornecedor::all();
        $subfamila = SubFamilia::all();
        $famila = Familia::all();

        return view('materia-prima')->with('precos', $precos)->with('fornecedores', $fornecedores)->with('subfamilias', $subfamila)->with('familias', $famila);
    }

    //funcao para retornar todas preços de matérias-primas 
    public function precos(Request $request)
    {
        $search = $request->input('search');
        $empresa_id = $request->input('empresa_id');
        $familia_id = $request->input('familia_id');
        $subfamilia_id = $request->input('subfamilia_id');
        $data1 = $request->input('data1');
        $data2 = $request->input('data2');

        $subfamila = SubFamilia::all();
        $famila = Familia::all();
        $empresas = Empresa::all();

        if (!empty($search)) {
            $materiaprima =  MateriaPrima::query()->where('designacao', 'LIKE', "%{$search}%")->pluck('id')->toArray();
            $precos = Preco::query()->whereIn('materiaprima_id', $materiaprima)->sortable()->paginate(15);
            
        } else {

            if (!empty($empresa_id) and !empty($familia_id) and !empty($subfamilia_id) and !empty($data1) and !empty($data2)) {

                $materiaprima =  MateriaPrima::query()->where('empresa_id', '=', $empresa_id, 'AND', 'familia_id', '=', $familia_id, 'AND', 'subfamilia_id', '=', $subfamilia_id)->first();

                if ($materiaprima != null) {
                    $precos = Preco::query()->where('materiaprima_id', $materiaprima->id)->whereDate('data_inicio', '>=' , $data1)->whereDate('data_fim', '<=' , $data2)->sortable()->paginate(15);
                } else {
                    $precos = Preco::query()->sortable()->paginate(15);
                }

            } else {
                $precos = Preco::query()->sortable()->paginate(15);
            }
        }

        return view('home')->with('precos', $precos)->with('subfamilias', $subfamila)->with('familias', $famila)->with('empresas', $empresas);
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

        return view('alterar-materia-prima')->with('materia_prima', $preco);
    }
}

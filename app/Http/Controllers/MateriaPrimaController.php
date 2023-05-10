<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use App\Models\MateriaPrima;
use App\Models\Familia;
use App\Models\Preco;
use App\Models\SubFamilia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MateriaPrimaController extends Controller
{
    //função para registar matéria-prima 
    public function registar(Request $request)
    {
        $data = $request->validate(
            [

                'designacao' => ['required', 'unique:materiasprimas'],
                'codigo' => ['required', 'unique:materiasprimas'],
                'concentracao' => ['required'],
                'familia' => ['required'],
                'subfamilia' => ['required'],
                'principio_activo' => ['required'],
            ],
            [
                'designacao.required' => 'Deve introduzir a designação da matéria-prima',
                'codigo.unique' => 'Já existe uma matéria-prima com este código',
                'concentracao.required' => 'Deve introduzir a concentração da matéria-prima',
                'familia.unique' => 'Deve selecionar a familia da matéria-prima',
                'subfamilia.email' => 'Deve selecionar a sub-familia da matéria-prima',
            ]
        );

        $materiaprima = new MateriaPrima();
        $materiaprima->designacao = $data['designacao'];
        $materiaprima->codigo = $data['codigo'];
        $materiaprima->concentracao = $data['concentracao'];
        $materiaprima->familia_id = $data['familia'];
        $materiaprima->subfamilia_id = $data['subfamilia'];
        $materiaprima->principio_activo = $data['principio_activo'];
        $materiaprima->empresa_id = Auth::User()->empresa_id;
        $materiaprima->save();

        return  redirect()->back()->with('success', 'Matéria-prima registada com sucesso');
    }

    //função para registar matéria-prima  
    public function alterar_materia_prima(Request $request)
    {
        $data = $request->validate(
            [

                'designacao' => ['required'], // "unique:materiasprimas,designacao,$request->id"
                'codigo' => ['required'], //, "unique:materiasprimas,codigo,$request->id"
                'concentracao' => ['required'],
                'familia' => ['required'],
                'subfamilia' => ['required'],
                'principio_activo' => ['required'],
            ],
            [
                'designacao.required' => 'Deve introduzir a designação da matéria-prima',
                'codigo.unique' => 'Já existe uma matéria-prima com este código',
                'concentracao.required' => 'Deve introduzir a concentração da matéria-prima',
                'familia.unique' => 'Deve selecionar a familia da matéria-prima',
                'subfamilia.email' => 'Deve selecionar a sub-familia da matéria-prima',
            ]
        );

        $materiaprima = MateriaPrima::where('id', '=', $request->id, 'AND', 'empresa_id', '=', Auth::User()->empresa_id)->first();
        $materiaprima->designacao = $data['designacao'];
        $materiaprima->codigo = $data['codigo'];
        $materiaprima->concentracao = $data['concentracao'];
        $materiaprima->familia_id = $data['familia'];
        $materiaprima->subfamilia_id = $data['subfamilia'];
        $materiaprima->principio_activo = $data['principio_activo'];

        $materiaprima->save();

        return  redirect('/materia-prima')->with('success', 'Matéria-prima alterada com sucesso');
    }

    //funcao para retornar todas matérias-primas 
    public function materias_primas(Request $request)
    {
        $search = $request->input('search');
        $fornecedores = Fornecedor::where('empresa_id', '=', Auth::User()->empresa_id)->get();
        $subfamila = SubFamilia::all();
        $famila = Familia::all();


        if (!empty($search)) {
            if (Auth::User()->u_tipo == 1) {
                $materiasprimas = MateriaPrima::with('familia', 'subfamilia')->where('designacao', 'LIKE', "%{$search}%")->sortable()->paginate(15);
            } else {
                $materiasprimas = MateriaPrima::with('familia', 'subfamilia')->where('deisgnacao', 'LIKE', "%{$search}%", 'AND', 'empresa_id', '=', Auth::User()->empresa_id)->sortable()->paginate(15);
            }
        } else {
            if (Auth::User()->u_tipo == 1) {
                $materiasprimas = MateriaPrima::with('familia', 'subfamilia')->sortable()->paginate(15);
            } else {
                $materiasprimas = MateriaPrima::with('familia', 'subfamilia')->where('empresa_id', '=', Auth::User()->empresa_id)->sortable()->paginate(15);
            }
        }
        return view('materia-prima')->with('materias_primas', $materiasprimas)->with('fornecedores', $fornecedores)->with('subfamilias', $subfamila)->with('familias', $famila);
    }

    //função para apagar uma matéria-prima 
    public function apagar_materia_prima(Request $request)
    {
        $materiaprima = MateriaPrima::where('id', '=', $request->id, 'AND', 'empresa_id', '=', Auth::User()->empresa_id)->first();

        if ($materiaprima != null) {
            $materiaprima->delete();
            return  redirect()->back()->with('success', 'Matéria-prima apagada com sucesso');
        }
        return  redirect()->back()->with('error', 'Não foi possivel apagar a matéria-prima ');
    }


    //função para retornar os dados da matéria-prima 
    public function dados_materia_prima(Request $request)
    {
        $materiaprima = MateriaPrima::with('familia', 'subfamilia')->where('id', '=', $request->id)->first();
        
        $subfamila = SubFamilia::all();
        $famila = Familia::all();

        return view('alterar-materia-prima')->with('materia_prima', $materiaprima)->with('subfamilias', $subfamila)->with('familias', $famila);
    }



    //função para retornar os dados da matéria-prima 
    public function precos_materias_primas(Request $request)
    {
        $id = MateriaPrima::with('familia', 'subfamilia')->where('codigo', $request->codigo)->pluck('id')->toArray();
        $materiaprima = MateriaPrima::with('familia', 'subfamilia')->where('codigo', $request->codigo)->first();

        $precos = Preco::with('materiaprima', 'fornecedor')->whereIn('materiaprima_id', $id)->orderBy('created_at', 'asc')->get();
        
        return view('materiaprima')->with('materiaprima', $materiaprima)->with('precos', $precos);
    }

    //função para registar familia de matéria-prima
    public function adicionar_familia(Request $request)
    {
        $data = $request->validate([
            'familia' => ['required', 'unique:familia'],
        ], [
            'familia.required' => 'Deve introduzir uma função',
            'familia.unique' => 'Esta familia já foi registada',
        ]);

        $familia = new Familia();
        $familia->familia = $data['familia'];

        $familia->save();

        return  redirect()->back()->with('success', 'Familia registada com sucesso');
    }

    //função para registar subfamilia de matéria-prima
    public function adicionar_subfamilia(Request $request)
    {
        $data = $request->validate([
            'subfamilia' => ['required', 'unique:subfamilia'],
        ], [
            'subfamilia.required' => 'Deve introduzir uma função',
            'subfamilia.unique' => 'Esta função já foi registada',
        ]);

        $subfamilia = new SubFamilia();
        $subfamilia->subfamilia = $data['subfamilia'];

        $subfamilia->save();

        return  redirect()->back()->with('success', 'Subfamilia registada com sucesso');
    }

    //função para retornar a view adicionar matéria-prima
    public function  veiw_adicionar_materia_prima(Request $request)
    {
        $subfamila = SubFamilia::all();
        $famila = Familia::all();

        return  view('adicionar-materia-prima')->with('subfamilias', $subfamila)->with('familias', $famila);
    }
}

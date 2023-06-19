<?php

namespace App\Http\Controllers;

use App\Models\Alerta;
use App\Models\Log;
use App\Models\Topico;
use App\Models\Fornecedor;
use App\Models\MateriaPrima;
use App\Models\Familia;
use App\Models\Codigo;
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
                'designacao' => ['required'],
                'codigo' => ['required'],
                'concentracao' => ['required'],
                'familia' => ['required'],
                'subfamilia' => ['required'],
            ],
            [
                'designacao.required' => 'Deve introduzir a designação da matéria-prima',
                'concentracao.required' => 'Deve introduzir a concentração da matéria-prima',
                'familia.required' => 'Deve selecionar a familia da matéria-prima',
                'subfamilia.required' => 'Deve selecionar a sub-familia da matéria-prima',
                'codigo.required' => 'Deve selecionar o codigo da matéria-prima',
            ]
        );

        $materiaprima = new MateriaPrima();
        $materiaprima->designacao = $data['designacao'];
        $materiaprima->codigo_id = $data['codigo'];
        $materiaprima->concentracao = $data['concentracao'];
        $materiaprima->familia_id = $data['familia'];
        $materiaprima->subfamilia_id = $data['subfamilia'];
        $materiaprima->empresa_id = Auth::User()->empresa_id;
        $materiaprima->save();

        $log = new Log();
        $log->user_id = Auth::User()->id;
        $log->data_hora = now();
        $log->acao = "adicionou matéria-prima";
        $log->save();

        return  redirect()->back()->with('success', 'Matéria-prima registada com sucesso');
    }

    //função para registar alerta matéria-prima 
    public function registar_alerta(Request $request)
    {
        $data = $request->validate(
            [
                'preco_minimo' => ['required', 'numeric'],
                'preco_maximo' => ['required', 'numeric', 'gt:preco_minimo'],
            ],
            [
                'preco_minimo.required' => 'Deve introduzir o preço minimo',
                'preco_maximo.required' => 'Deve introduzir o preço maximo',
            ]
        );

        $alerta = new Alerta();
        $alerta->materiaprima_id = $request->id;
        $alerta->preco_minimo = $data['preco_minimo'];
        $alerta->preco_maximo = $data['preco_maximo'];
        $alerta->user_id = Auth::User()->id;
        $alerta->save();

        return  redirect()->back()->with('success', 'Alerta registada com sucesso');
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
            ],
            [
                'designacao.required' => 'Deve introduzir a designação da matéria-prima',
                'concentracao.required' => 'Deve introduzir a concentração da matéria-prima',
                'familia.required' => 'Deve selecionar a familia da matéria-prima',
                'subfamilia.required' => 'Deve selecionar a sub-familia da matéria-prima',
                'codigo.required' => 'Deve selecionar o codigo da matéria-prima',
            ]
        );

        $materiaprima = MateriaPrima::where('id', '=', $request->id, 'AND', 'empresa_id', '=', Auth::User()->empresa_id)->first();
        $materiaprima->designacao = $data['designacao'];
        $materiaprima->codigo_id = $data['codigo'];
        $materiaprima->concentracao = $data['concentracao'];
        $materiaprima->familia_id = $data['familia'];
        $materiaprima->subfamilia_id = $data['subfamilia'];

        $materiaprima->save();

        $log = new Log();
        $log->user_id = Auth::User()->id;
        $log->data_hora = now();
        $log->acao = "alterou matéria-prima";
        $log->save();

        return  redirect('/materia-prima')->with('success', 'Matéria-prima alterada com sucesso');
    }

    //funcao para retornar todas matérias-primas 
    public function materias_primas(Request $request)
    {
        $search = $request->input('search');
        $fornecedores = Fornecedor::all();
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

    //filtra matérias-primas 
    public function materias_primas_filtros(Request $request)
    {
        $fornecedores = Fornecedor::all();
        $subfamila = SubFamilia::all();
        $famila = Familia::all();

        if (Auth::User()->u_tipo == 1) {

            if ($request->tipo == 1) {
                $materiasprimas = MateriaPrima::with('familia', 'subfamilia')->where('familia_id',$request->id )->paginate(15);
                return view('materia-prima')->with('materias_primas', $materiasprimas)->with('fornecedores', $fornecedores)->with('subfamilias', $subfamila)->with('familias', $famila);
            }

            if ($request->tipo == 2) {
                $materiasprimas = MateriaPrima::with('familia', 'subfamilia')->where('subfamilia_id',$request->id )->paginate(15);
                return view('materia-prima')->with('materias_primas', $materiasprimas)->with('fornecedores', $fornecedores)->with('subfamilias', $subfamila)->with('familias', $famila);
            }

            if ($request->tipo == 3) {

                if ($request->id == 1) {

                    $materiasprimas = MateriaPrima::with('familia', 'subfamilia')->orderBy('designacao', 'ASC')->paginate(15);
                    return view('materia-prima')->with('materias_primas', $materiasprimas)->with('fornecedores', $fornecedores)->with('subfamilias', $subfamila)->with('familias', $famila);
                }
                if ($request->id == 2) {
                    $materiasprimas = MateriaPrima::with('familia', 'subfamilia', 'codigo')->join('codigo', 'codigo.id' ,'=', 'materiasprimas.codigo_id')->orderBy('codigo.codigo', 'ASC')->sortable()->paginate(15);
                    return view('materia-prima')->with('materias_primas', $materiasprimas)->with('fornecedores', $fornecedores)->with('subfamilias', $subfamila)->with('familias', $famila);
                }
                if ($request->id == 3) {
                    $materiasprimas = MateriaPrima::with('familia', 'subfamilia')->orderBy('familia.familia', 'ASC')->sortable()->paginate(15);
                    return view('materia-prima')->with('materias_primas', $materiasprimas)->with('fornecedores', $fornecedores)->with('subfamilias', $subfamila)->with('familias', $famila);
                }
                if ($request->id == 4) {
                    $materiasprimas = MateriaPrima::with('familia', 'subfamilia')->orderBy('subfamilia.subfamilia', 'ASC')->sortable()->paginate(15);
                    return view('materia-prima')->with('materias_primas', $materiasprimas)->with('fornecedores', $fornecedores)->with('subfamilias', $subfamila)->with('familias', $famila);
                }
            }
        } else {
            $materiasprimas = MateriaPrima::with('familia', 'subfamilia')->where('empresa_id', '=', Auth::User()->empresa_id)->sortable()->paginate(15);
        }

        return view('materia-prima')->with('materias_primas', $materiasprimas)->with('fornecedores', $fornecedores)->with('subfamilias', $subfamila)->with('familias', $famila);
    }

    //função para apagar uma matéria-prima 
    public function apagar_materia_prima(Request $request)
    {
        $materiaprima = MateriaPrima::where('id', '=', $request->id, 'AND', 'empresa_id', '=', Auth::User()->empresa_id)->first();

        if ($materiaprima != null) {
            $materiaprima->delete();

            $log = new Log();
            $log->user_id = Auth::User()->id;
            $log->data_hora = now();
            $log->acao = "removeu matéria-prima";
            $log->save();

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
        $codigo = Codigo::all();

        return view('alterar-materia-prima')->with('codigo', $codigo)->with('materia_prima', $materiaprima)->with('subfamilias', $subfamila)->with('familias', $famila);
    }



    //função para retornar os dados da matéria-prima 
    public function precos_materias_primas(Request $request)
    {
        $id = MateriaPrima::with('familia', 'subfamilia')->where('codigo_id', $request->codigo)->pluck('id')->toArray();
        $materiaprima = MateriaPrima::with('familia', 'subfamilia')->where('codigo_id', $request->codigo)->first();

        $precos = Preco::with('materiaprima', 'fornecedor')->whereIn('materiaprima_id', $id)->orderBy('created_at', 'desc')->get();

        $topicos = Topico::query()->where('familia_id', $materiaprima->familia->id)->orderBy('created_at', 'desc')->get();

        return view('materiaprima')->with('materiaprima', $materiaprima)->with('precos', $precos)->with('topicos', $topicos);
    }

    //função para registar familia de matéria-prima
    public function adicionar_codigo(Request $request)
    {
        $data = $request->validate([
            'codigo' => ['required', 'unique:codigo'],
            'principio_ativo' => ['required'],
        ], [
            'codigo.required' => 'Deve introduzir um codigo',
            'codigo.unique' => 'O codigo já foi registado',
            'principio_activo.required' => 'Deve introduzir o principio ativo',
        ]);

        $codigo = new Codigo();
        $codigo->codigo = $data['codigo'];
        $codigo->principio_ativo = $data['principio_ativo'];

        $codigo->save();

        $log = new Log();
        $log->user_id = Auth::User()->id;
        $log->data_hora = now();
        $log->acao = "adicionou codigo";
        $log->save();

        return  redirect()->back()->with('success', 'Codigo registado com sucesso');
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

        $log = new Log();
        $log->user_id = Auth::User()->id;
        $log->data_hora = now();
        $log->acao = "adicionou famila de matéria-prima";
        $log->save;

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

        $log = new Log();
        $log->user_id = Auth::User()->id;
        $log->data_hora = now();
        $log->acao = "adicionou sub-famila de matéria-prima";
        $log->save;

        return  redirect()->back()->with('success', 'Subfamilia registada com sucesso');
    }

    //função para retornar a view adicionar matéria-prima
    public function  veiw_adicionar_materia_prima(Request $request)
    {
        $subfamila = SubFamilia::all();
        $famila = Familia::all();
        $codigo = Codigo::all();

        return  view('adicionar-materia-prima')->with('codigo', $codigo)->with('subfamilias', $subfamila)->with('familias', $famila);
    }
}

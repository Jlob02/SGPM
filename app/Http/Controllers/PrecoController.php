<?php

namespace App\Http\Controllers;

use App\Models\Alerta;
use App\Models\Empresa;
use App\Models\Log;
use App\Models\Familia;
use App\Models\Fornecedor;
use App\Models\Preco;
use App\Models\MateriaPrima;
use App\Models\SubFamilia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\AlertaPrecoMail;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PrecoExport;

class PrecoController extends Controller
{
    //função para registar matéria-prima 
    public function registar_preco(Request $request)
    {
        $inputs = $request->validate(
            [
                'inputs.*.preco' => ['required'],
                'inputs.*.unidade' => ['required'],
                'inputs.*.fornecedor' => ['required', 'integer'],
                'inputs.*.quantidade_minima' => ['required', 'integer'],
                'inputs.*.data_inicio' => ['required', 'date'],
                'inputs.*.data_fim' => ['required', 'date', 'after:data_inicio'],
            ],
            [
                'inputs.*.preco.required' => 'Deve introduzir o preço da matéria-prima',
                'inputs.*.unidade.required' => 'Deve selecionar a unidade da matéria-prima',
                'inputs.*.data_inicio.required' => 'Deve introduzir a data de inicio',
                'inputs.*.data_fim.unique' => 'Já existe uma matéria-prima com este código',
                'inputs.*.fornecedor.integer' => 'Deve selecionar um fornecedor',
                'inputs.*.quantidade_minima.required' => 'Deve selecionar a quantidade minima da matéria-prima',
            ]
        );

        foreach ($request->inputs as $data) {

            $sinal = Preco::where('materiaprima_id', '=', $request->id, 'AND', 'fornecedor_id', '=', $data['fornecedor'],'AND', 'empresa_id', '=', Auth::User()->empresa_id )->orderBy('created_at', 'desc')->first();
            
            $preco = new Preco();
            $preco->preco = $data['preco'];
            $preco->unidade = $data['unidade'];
            $preco->observacao = $data['observacao'];
            $preco->quantidade_minima = $data['quantidade_minima'];
            $preco->fornecedor_id = $data['fornecedor'];
            $preco->data_inicio = $data['data_inicio'];
            $preco->data_fim = $data['data_fim'];
            $preco->empresa_id = Auth::User()->empresa_id;
            $preco->materiaprima_id = $request->id;
            $preco->user_id = Auth::User()->id;

            if ($sinal != null){
                if($sinal->preco > $data['preco']){
                    $preco->sinal = 1;
                }else{
                    if($sinal->preco < $data['preco']){
                        $preco->sinal = 3;
                    }else{
                        $preco->sinal = 2;
                    }
                }
            }

            $preco->save();

            $alertas = Alerta::with('materiaprima', 'user')->where('preco_minimo', '<=', $data['preco'], 'AND', 'preco_maximo', '>=', $data['preco'])->get();

            foreach ($alertas as $alerta) {
                Mail::to($alerta->user->email)->send(new AlertaPrecoMail($alerta->materiaprima->nome, $data['preco']));
                $alerta->delete();
            }
        }

        $log = new Log();
        $log->user_id = Auth::User()->id;
        $log->data_hora = now();
        $log->acao = "adicionou preço de matéria-prima";
        $log->save();


        return  redirect()->back()->with('success', 'Preço registado com sucesso');
    }


    //funcao para retornar todas preços de matérias-primas de uma empresa
    public function precos_materias_primas(Request $request)
    {
        $search = $request->input('search');
    
        if (!empty($search)) {
            $materiasprima = MateriaPrima::where('designacao', 'LIKE', "%{$search}%")->first();
            if ($materiasprima != null)
                $precos = Preco::with('materiaprima', 'fornecedor')->where('materiaprima_id', $materiasprima->id)->sortable()->paginate(15);
            else
                $precos = Preco::with('materiaprima', 'fornecedor')->where('materiaprima_id', 0)->sortable()->paginate(15);
        } else {
            $precos = Preco::with('materiaprima', 'fornecedor')->where('empresa_id', '=', Auth::User()->empresa_id)->sortable()->paginate(15);
        }

        return view('precos')->with('precos', $precos);
    }

    //funcao para retornar todos alertas de de preço de cada utilizador
    public function alertas_precos(Request $request)
    {
        $search = $request->input('search');

        if (!empty($search)) {
            $materiasprima = MateriaPrima::where('designacao', 'LIKE', "%{$search}%", 'AND', 'empresa_id', '=', Auth::User()->empresa_id)->first();
            if ($materiasprima != null) {
                $alertas = Alerta::with('materiaprima')->where('user_id', '=',  Auth::User()->id, 'AND', 'materiaprima_id', '=', $materiasprima->id)->sortable()->paginate(15);
                return view('alertas')->with('alertas', $alertas);
            }
        }

        $alertas = Alerta::with('materiaprima')->where('user_id', '=',  Auth::User()->id)->sortable()->paginate(15);
        return view('alertas')->with('alertas', $alertas);
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
        $logs = Log::query()->take(25)->orderBy('created_at', 'desc')->get();

        if (!empty($search)) {
            $materiaprima =  MateriaPrima::query()->where('designacao', 'LIKE', "%{$search}%")->pluck('id')->toArray();
            $precos = Preco::query()->whereIn('materiaprima_id', $materiaprima)->orderBy('created_at', 'desc')->sortable()->paginate(10);
            return view('home')->with('logs', $logs)->with('precos', $precos)->with('subfamilias', $subfamila)->with('familias', $famila)->with('empresas', $empresas);
        } else {

            if (!empty($empresa_id) and !empty($familia_id) and !empty($subfamilia_id) and !empty($data1) and !empty($data2)) {

                $id =  MateriaPrima::query()->where('empresa_id', '=', $empresa_id, 'AND', 'familia_id', '=', $familia_id, 'AND', 'subfamilia_id', '=', $subfamilia_id)->pluck('id')->toArray();

                if ($id != null) {
                    $precos = Preco::query()->whereIn('materiaprima_id', $id)->whereDate('data_inicio', '>=', $data1)->whereDate('data_fim', '<=', $data2)->orderBy('created_at', 'desc')->sortable()->paginate(10);
                    return view('home')->with('logs', $logs)->with('precos', $precos)->with('subfamilias', $subfamila)->with('familias', $famila)->with('empresas', $empresas);
                } else {
                    $precos = Preco::query()->where('materiaprima_id', 0)->whereDate('data_inicio', '>=', $data1)->whereDate('data_fim', '<=', $data2)->orderBy('created_at', 'desc')->sortable()->paginate(10);
                    return view('home')->with('logs', $logs)->with('precos', $precos)->with('subfamilias', $subfamila)->with('familias', $famila)->with('empresas', $empresas);
                }
            }

            if (!empty($empresa_id) and !empty($familia_id) and !empty($subfamilia_id)) {

                $id =  MateriaPrima::query()->where('empresa_id', '=', $empresa_id, 'AND', 'familia_id', '=', $familia_id, 'AND', 'subfamilia_id', '=', $subfamilia_id)->pluck('id')->toArray();

                if ($id != null) {
                    $precos = Preco::query()->whereIn('materiaprima_id', $id)->orderBy('created_at', 'desc')->sortable()->paginate(10);
                    return view('home')->with('logs', $logs)->with('precos', $precos)->with('subfamilias', $subfamila)->with('familias', $famila)->with('empresas', $empresas);
                } else {
                    $precos = Preco::query()->where('materiaprima_id', 0)->orderBy('created_at', 'desc')->sortable()->paginate(10);
                    return view('home')->with('logs', $logs)->with('precos', $precos)->with('subfamilias', $subfamila)->with('familias', $famila)->with('empresas', $empresas);
                }
            }

            if (!empty($empresa_id) and !empty($familia_id)) {

                $id =  MateriaPrima::query()->where('empresa_id', '=', $empresa_id, 'AND', 'familia_id', '=', $familia_id)->pluck('id')->toArray();

                if ($id != null) {
                    $precos = Preco::query()->whereIn('materiaprima_id', $id)->orderBy('created_at', 'desc')->sortable()->paginate(10);
                    return view('home')->with('logs', $logs)->with('precos', $precos)->with('subfamilias', $subfamila)->with('familias', $famila)->with('empresas', $empresas);
                } else {
                    $precos = Preco::query()->where('materiaprima_id', 0)->orderBy('created_at', 'desc')->sortable()->paginate(10);
                    return view('home')->with('logs', $logs)->with('precos', $precos)->with('subfamilias', $subfamila)->with('familias', $famila)->with('empresas', $empresas);
                }
            }

            if (!empty($empresa_id) and !empty($subfamilia_id)) {

                $id =  MateriaPrima::query()->where('empresa_id', '=', $empresa_id, 'subfamilia_id', '=', $subfamilia_id)->pluck('id')->toArray();

                if ($id != null) {
                    $precos = Preco::query()->whereIn('materiaprima_id', $id)->orderBy('created_at', 'desc')->sortable()->paginate(10);
                    return view('home')->with('logs', $logs)->with('precos', $precos)->with('subfamilias', $subfamila)->with('familias', $famila)->with('empresas', $empresas);
                } else {
                    $precos = Preco::query()->where('materiaprima_id', 0)->orderBy('created_at', 'desc')->sortable()->paginate(10);
                    return view('home')->with('logs', $logs)->with('precos', $precos)->with('subfamilias', $subfamila)->with('familias', $famila)->with('empresas', $empresas);
                }
            }

            if (!empty($familia_id) and !empty($subfamilia_id)) {

                $id =  MateriaPrima::query()->where('familia_id', '=', $familia_id, 'AND', 'subfamilia_id', '=', $subfamilia_id)->pluck('id')->toArray();

                if ($id != null) {
                    $precos = Preco::query()->whereIn('materiaprima_id', $id)->orderBy('created_at', 'desc')->sortable()->paginate(10);
                    return view('home')->with('logs', $logs)->with('precos', $precos)->with('subfamilias', $subfamila)->with('familias', $famila)->with('empresas', $empresas);
                } else {
                    $precos = Preco::query()->where('materiaprima_id', 0)->orderBy('created_at', 'desc')->sortable()->paginate(10);
                    return view('home')->with('logs', $logs)->with('precos', $precos)->with('subfamilias', $subfamila)->with('familias', $famila)->with('empresas', $empresas);
                }
            }

            if (!empty($empresa_id)) {

                $id =  MateriaPrima::query()->where('empresa_id', '=', $empresa_id)->pluck('id')->toArray();

                if ($id != null) {
                    $precos = Preco::query()->whereIn('materiaprima_id', $id)->orderBy('created_at', 'desc')->sortable()->paginate(10);
                    return view('home')->with('logs', $logs)->with('precos', $precos)->with('subfamilias', $subfamila)->with('familias', $famila)->with('empresas', $empresas);
                } else {
                    $precos = Preco::query()->where('materiaprima_id', 0)->orderBy('created_at', 'desc')->sortable()->paginate(10);
                    return view('home')->with('logs', $logs)->with('precos', $precos)->with('subfamilias', $subfamila)->with('familias', $famila)->with('empresas', $empresas);
                }
            }

            if (!empty($familia_id)) {

                $id =  MateriaPrima::query()->where('familia_id', '=', $familia_id)->pluck('id')->toArray();

                if ($id != null) {
                    $precos = Preco::query()->whereIn('materiaprima_id', $id)->orderBy('created_at', 'desc')->sortable()->paginate(10);
                    return view('home')->with('logs', $logs)->with('precos', $precos)->with('subfamilias', $subfamila)->with('familias', $famila)->with('empresas', $empresas);
                } else {
                    $precos = Preco::query()->where('materiaprima_id', 0)->orderBy('created_at', 'desc')->sortable()->paginate(10);
                    return view('home')->with('logs', $logs)->with('precos', $precos)->with('subfamilias', $subfamila)->with('familias', $famila)->with('empresas', $empresas);
                }
            }

            if (!empty($subfamilia_id)) {

                $id =  MateriaPrima::query()->where('subfamilia_id', '=', $subfamilia_id)->pluck('id')->toArray();

                if ($id != null) {
                    $precos = Preco::query()->whereIn('materiaprima_id', $id)->orderBy('created_at', 'desc')->sortable()->paginate(10);
                    return view('home')->with('logs', $logs)->with('precos', $precos)->with('subfamilias', $subfamila)->with('familias', $famila)->with('empresas', $empresas);
                } else {
                    $precos = Preco::query()->where('materiaprima_id', 0)->orderBy('created_at', 'desc')->sortable()->paginate(10);
                    return view('home')->with('logs', $logs)->with('precos', $precos)->with('subfamilias', $subfamila)->with('familias', $famila)->with('empresas', $empresas);
                }
            }

            if (!empty($data1) and !empty($data2)) {

                $precos = Preco::query()->whereDate('data_inicio', '>=', $data1)->whereDate('data_fim', '<=', $data2)->orderBy('created_at', 'desc')->sortable()->paginate(10);
                return view('home')->with('logs', $logs)->with('precos', $precos)->with('subfamilias', $subfamila)->with('familias', $famila)->with('empresas', $empresas);
            }
        }

        $precos = Preco::query()->orderBy('created_at', 'desc')->sortable()->paginate(10);

        return view('home')->with('logs', $logs)->with('precos', $precos)->with('subfamilias', $subfamila)->with('familias', $famila)->with('empresas', $empresas);
    }

    //função para apagar uma matéria-prima 
    public function apagar_preco(Request $request)
    {
        $preco = Preco::where('id', '=', $request->id, 'AND', 'empresa_id', '=', Auth::User()->empresa_id)->first();

        if ($preco != null) {
            $preco->delete();

            $log = new Log();
            $log->user_id = Auth::User()->id;
            $log->data_hora = now();
            $log->acao = "removeu preço de matéria-prima";
            $log->save();

            return  redirect()->back()->with('success', 'Preço apagado com sucesso');
        }
        return  redirect()->back()->with('error', 'Não foi possivel apagar o preço');
    }

    //função para apagar alerta
    public function apagar_alerta(Request $request)
    {
        $alerta = Alerta::where('id', '=', $request->id, 'AND', 'user_id', '=', Auth::User()->id)->first();

        if ($alerta != null) {
            $alerta->delete();

            return  redirect()->back()->with('success', 'Alerta removida com sucesso');
        }
        return  redirect()->back()->with('error', 'Não foi possivel remover o alerta');
    }

    //função para retornar os dados da matéria-prima 
    public function dados_materia_prima(Request $request)
    {
        $preco = Preco::where('id', '=', $request->id)->first();

        return view('alterar-materia-prima')->with('materia_prima', $preco);
    }

    public function export(Request $request) 
    {
        return Excel::download(new PrecoExport( $request->id), 'Preço_'.now().'.csv');
    }
}

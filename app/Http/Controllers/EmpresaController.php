<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmpresaController extends Controller
{
    //função para registar empresa
     public function registar_empresa(Request $request)
     {
         $data = $request->validate([
             'nome' => ['required'],
             'email' => ['required', 'email', 'unique:empresas'],
             'contacto' => ['required', 'unique:empresas'],
             'nome_responsavel' => ['required'],
             'localidade' => ['required'],
             'pais' => ['required'],
         ],[
             'nome.required'=> 'Deve introduzir o nome da empresa',
             'email.required'=> 'Deve introduzir o email da empresa',
             'email.unique'=> 'Ja existe uma empresa com conta associada a este email',
             'emali.email'=> 'Deve introduzir um email válido',
             'contacto.required'=> 'Deve introduzir o contacto da empresa',
             'contacto.unique'=> 'Ja existe uma empresa com conta associada a este número'
         ]);
 
         $empresa = new Empresa();
         $empresa->email = $data['email'];
         $empresa->nome = $data['nome'];
         $empresa->contacto = $data['contacto'];
         $empresa->nome_responsavel = $data['nome_responsavel'];
         $empresa->estado = 1;
         $empresa->localidade = $data['localidade'];
         $empresa->pais = $data['pais'];
 
         $empresa->save();
 
         return  redirect()->back()->with('success', 'Empresa registada com sucesso');
 
     }

     //função para retornar todas empresas 
     public function empresas(Request $request){

        $empresas = Empresa::sortable()->paginate(15);
        return view('empresas')->with('empresas',$empresas);
    }


     //função para apagar uma empresa
     public function apagar_empresa(Request $request){
        if(Auth::user()->u_tipo == 1){
            $empresa =Empresa::where('id', '=', $request->id)->first();
        }

        $empresa->delete();
        return  redirect()->back()->with('success', 'Utilizador apagado com sucesso');
    }

    //função para alterar o estado da empresa
    public function alterar_estado_empresa(Request $request){

        if(Auth::user()->u_tipo == 1){
            $empresa = Empresa::where('id', '=', $request->id)->first();
        }
        
        if($request->estado == 1){
            $empresa->estado = 0;
        }else{
            $empresa->estado = 1;
        }

        $empresa->save();
        return  redirect()->back()->with('success', 'Estado alterado com sucesso');
    }


}

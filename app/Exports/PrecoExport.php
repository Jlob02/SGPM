<?php

namespace App\Exports;

use App\Models\Preco;
use App\Models\MateriaPrima;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Http\Request;


class PrecoExport implements FromCollection, WithHeadings
{
    
    public $id;
    public $data_inicio;
    public $data_fim;
    public $tipo;
    public $empresa_id;

    /**
     * Create a new message instance.
     */
    public function __construct(Request $request)
    {
        $this->id =  $request->id;
        $this->data_inicio =  $request->data_inicio;
        $this->data_fim =  $request->data_fim;
        $this->tipo =  $request->tipo;
        $this->empresa_id =  $request->empresa_id;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {   
        if (isset($this->empresa_id) && isset($this->tipo)) {
            return Preco::join('materiasprimas', 'materiasprimas.id', '=', 'precos.materiaprima_id')
        ->join('fornecedores', 'fornecedores.id', '=', 'precos.fornecedor_id')
        ->join('empresas', 'empresas.id' ,'=', 'precos.empresa_id')
        ->where('materiasprimas.codigo_id', '=', $this->id, 'AND' , 'precos.empresa_id', '=' , $this->empresa_id)->whereBetween('precos.created_at', [$this->data_inicio, $this->data_fim])->orderBy('precos.created_at', 'desc')->get(['fornecedores.pais','empresas.nome','fornecedores.nome AS name', 'precos.quantidade_minima', 'precos.data_inicio', 'precos.data_fim', 'precos.preco', DB::Raw('(CASE WHEN precos.unidade = "1" THEN "Kg" ELSE "T" END) AS unidade') ]);
        }
        
        return Preco::join('materiasprimas', 'materiasprimas.id', '=', 'precos.materiaprima_id')
        ->join('fornecedores', 'fornecedores.id', '=', 'precos.fornecedor_id')
        ->join('empresas', 'empresas.id' ,'=', 'precos.empresa_id')
        ->where('materiasprimas.codigo_id', '=', $this->id)->whereBetween('precos.created_at', [$this->data_inicio, $this->data_fim])->orderBy('precos.created_at', 'desc')->get(['fornecedores.pais','empresas.nome','fornecedores.nome AS name', 'precos.quantidade_minima', 'precos.data_inicio', 'precos.data_fim', 'precos.preco', DB::Raw('(CASE WHEN precos.unidade = "1" THEN "Kg" 
        ELSE "T" 
        END) AS unidade') ]);
    }

    public function headings(): array{
        return ["Pais","Empresa", "Fornecedor", "Quant Minima", "Data de Inicio", "Data de Fim", "Preco","Unidade"];
    }
}

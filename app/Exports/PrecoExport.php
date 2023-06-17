<?php

namespace App\Exports;

use App\Models\Preco;
use App\Models\MateriaPrima;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class PrecoExport implements FromCollection, WithHeadings
{
    
    public $id;

    /**
     * Create a new message instance.
     */
    public function __construct($id)
    {
        $this->id = $id;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {   
        return Preco::join('materiasprimas', 'materiasprimas.id', '=', 'precos.materiaprima_id')
        ->join('fornecedores', 'fornecedores.id', '=', 'precos.fornecedor_id')
        ->join('empresas', 'empresas.id' ,'=', 'precos.empresa_id')
        ->where('materiasprimas.codigo_id', '=', $this->id)->orderBy('precos.created_at', 'desc')->get(['fornecedores.pais','empresas.nome','fornecedores.nome AS name', 'precos.quantidade_minima', 'precos.data_inicio', 'precos.data_fim', 'precos.preco', DB::Raw('(CASE WHEN precos.unidade = "1" THEN "Kg" 
        ELSE "T" 
        END) AS unidade') ]);
    }

    public function headings(): array{
        return ["Pais","Empresa", "Fornecedor", "Quant Minima", "Data de Inicio", "Data de Fim", "Preco","Unidade"];
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Preco extends Model
{
    use  HasFactory,  Sortable;
    protected $table = 'precos';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'preco',
        'unidade',
        'materia_prima_id',
        'fornecedor_id',
        'empresa_id',
        'data_inicio',
        'data_fim',
    ];

    protected $sortable = ['id','preco'];
}

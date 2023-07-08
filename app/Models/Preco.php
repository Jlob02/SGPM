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
        'user_id',
        'preco',
        'unidade',
        'quantidade_minima',
        'observacao',
        'materiaprima_id',
        'fornecedor_id',
        'empresa_id',
        'data_inicio',
        'data_fim',
        'sinal',
        'created_at',
    ];

    protected $sortable = ['id','preco'];

    public function materiaprima()
    {
        return $this->belongsTo(MateriaPrima::class);
    }

    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Fornecedor extends Model
{
    use  HasFactory,  Sortable;
    protected $table = 'fornecedores';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'nome',
        'email',
        'pais',
        'contacto',
        'pessoa_contacto',
        'empresa_id'
    ];

    protected $sortable = ['nome', 'email', 'contacto'];


    public function precos()
    {
        return $this->hasMany(Preco::class);
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}

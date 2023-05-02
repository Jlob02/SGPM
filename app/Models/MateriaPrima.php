<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class MateriaPrima extends Model
{
    use  HasFactory,  Sortable;
    protected $table = 'materiasprimas';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'designacao',
        'codigo',
        'concentracao',
        'familia_id',
        'subfamilia_id',
        'principio_activo',
        'empresa_id'
    ];

    protected $sortable = ['desgnacao', 'codigo', 'id', 'familia', 'subfamilia', 'concentracao'];

    public function familia()
    {
        return $this->belongsTo(Familia::class);
    }

    public function subfamilia()
    {
        return $this->belongsTo(SubFamilia::class);
    }

    public function precos()
    {
        return $this->hasMany(Preco::class);
    }

    public function empresa()
    {

        return $this->belongsTo(Empresa::class);
    }
}

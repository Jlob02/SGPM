<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Alerta extends Model
{
    use  HasFactory, Sortable;
    protected $table = 'alertas';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'user_id',
        'preco_minimo',
        'preco_maximo',
        'estado',
        'materiaprima_id'
    ];

    public function materiaprima()
    {
        return $this->belongsTo(MateriaPrima::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

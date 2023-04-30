<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Empresa extends Model
{
    use HasFactory, Sortable;

    protected $table = 'empresas';
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
        'contacto',
        'nome_responsavel',
        'estado',
        'localidade',
        'pais',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        //'email_verified_at' => 'datetime',
    ];

    protected $sortable = ['nome','id'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function materiaprima()
    {
        return $this->hasMany(MateriaPrima::class);
    }
}

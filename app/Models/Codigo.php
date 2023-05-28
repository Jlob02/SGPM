<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Codigo extends Model
{
    use  HasFactory, Sortable;
    protected $table = 'codigo';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'codigo',
        'principio_ativo'
    ];

    public function materiaprima()
    {
        return $this->hasMany(MateriaPrima::class);
    }
}

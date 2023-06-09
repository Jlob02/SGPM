<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class SubFamilia extends Model
{
    use  HasFactory, Sortable;
    protected $table = 'subfamilia';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'subfamilia',
    ];

    public function materiasprimas()
    {
        return $this->hasMany(MateriaPrima::class);
    }
}

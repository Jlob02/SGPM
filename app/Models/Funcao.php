<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Funcao extends Model
{
    use  HasFactory, Sortable;
    protected $table = 'funcao';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'funcao',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}

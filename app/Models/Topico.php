<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Topico extends Model
{
    use  HasFactory, Sortable;
    protected $table = 'topicos';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'user_id',
        'titulo',
        'descricao',
        'data_hora',
        'comentado',
        'familia_id'
    ];

    public function familia()
    {
        return $this->belongsTo(Familia::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

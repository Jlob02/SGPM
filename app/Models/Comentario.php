<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Comentario extends Model
{
    use  HasFactory, Sortable;
    protected $table = 'comentarios';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'user_id',
        'comentario',
        'data_hora',
        'topico_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function topico()
    {
        return $this->belongsTo(Topico::class);
    }
}

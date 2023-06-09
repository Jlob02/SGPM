<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Sortable;
    protected $table = 'users';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'u_nome',
        'email',
        'u_tipo',
        'funcao_id',
        'u_contacto',
        'u_estado',
        'empresa_id',
        'password',
        'forum_notificacao',
        'token'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        //'email_verified_at' => 'datetime',
    ];

    protected $sortable = ['u_nome', 'id'];

    public function funcao()
    {
        return $this->belongsTo(Funcao::class);
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoUser extends Model
{
    use HasFactory;
    public $table = "grupo_users";
    protected $fillable = [
        'fecha_registro',
        'habilitado_chat',
        'habilitado_grupo',
        'user_id',
        'grupo_id'
    ];

    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public static function estudiantes()
    {
        return static::whereHas('user.estudiante')->get();
    }
}

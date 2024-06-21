<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;
    public $table = "estudiantes";
    protected $fillable=[
        'puntuacion',
        'nivel_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function tutor()
    {
        return $this->belongsTo(Tutor::class);
    }

    public function estudianteProfesor()
    {
        return $this->hasMany(EstudianteProfesor::class);
    }
    
    public function puntuacionEjercicios()
    {
        return $this->hasMany(PuntuacionEjercicio::class);
    }

    public function niveles()
    {
        return $this->belongsTo(Nivel::class, 'nivel_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PuntuacionEjercicio extends Model
{
    use HasFactory;
    public $table = "puntuacion_ejercicios";
    protected $fillable = [
        'puntuacion_obtenida',
        'ejercicio_id',
        'estudiante_id'
    ];

    public function ejercicio()
    {
        return $this->belongsTo(Ejercicio::class);
    }

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    public $table = "plans";

    protected $fillable = [
        'titulo',
        'mes',
        'costo',
        'suscripcion_id'
    ];

    public function suscripciones()
    {
        return $this->hasMany(Suscripcion::class);
    }
}

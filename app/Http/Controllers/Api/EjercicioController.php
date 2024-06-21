<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ejercicio;
use App\Models\Estudiante;
use App\Notifications\NotificacionEjercicio;
use F9Web\ApiResponseHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EjercicioController extends Controller
{
    use ApiResponseHelpers;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function registrarPuntaje(string $idEjercicio, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'puntos' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return $this->respondFailedValidation($validator->errors());
        }

        $ejercicio = Ejercicio::find($idEjercicio);
        if (!$ejercicio) {
            return $this->respondError("El ID del ejercicio es inválido");
        }

        $estudiante = Estudiante::find($request->user_id);
        if (!$estudiante) {
            return $this->respondError("El ID del estudiante es inválido");
        }

        $profesoresValidos = $estudiante->estudianteProfesor->where('estado', true);
        //return $profesoresValidos->first();
        foreach ($profesoresValidos as $profesorvalido) {
            $mensaje = "El estudiante " . $estudiante->user->name . " " . $estudiante->user->lastname . ", ha obtenido en el ejercicio " . $ejercicio->nombre . " " . $request->puntos . " puntos.";
            $profesorvalido->profesor->user->notify(new NotificacionEjercicio($mensaje, $ejercicio->id, $estudiante->id));
        }

        $puntuacionEjercicio = $ejercicio->puntuacionEjercicios()->create([
            'puntuacion_obtenida' => $request->puntos,
            'estudiante_id' => $estudiante->id
        ]);

        return $this->respondSuccess($puntuacionEjercicio);
    }
}

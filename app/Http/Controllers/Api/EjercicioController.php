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

    public function registrarPuntaje(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ejercicio_id' => 'required|exists:ejercicios,id',
            'fecha_registro'=> 'required',
            'user_id' => 'required|exists:users,id', //user del estudiante
            'puntos' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return $this->respondFailedValidation($validator->errors());
        }
        $ejercicio = Ejercicio::find($request->ejercicio_id);
        $estudiante = Estudiante::find($request->user_id);
        $profesoresValidos = $estudiante->estudianteProfesor->where('estado', true);
        $estudiante->puntuacion=(int)$estudiante->puntuacion+(int)$request->puntos;
        $estudiante->save();
        foreach ($profesoresValidos as $profesorvalido) {
            $content = "El estudiante " . $estudiante->user->name . " " . $estudiante->user->lastname . " ha completado el ejercicio '" . $ejercicio->nombre . "' y ha obtenido " . $request->puntos . " puntos.";
            $profesorvalido->profesor->user->notify(new NotificacionEjercicio('Ejercicio realizado',$content,$estudiante->user->image,$ejercicio->id,$estudiante->id));
        }

        $puntuacionEjercicio = $ejercicio->puntuacionEjercicios()->create([
            'puntuacion_obtenida' => $request->puntos,
            'fecha_registro'=>$request->fecha_registro,
            'estudiante_id' => $estudiante->id
        ]);
        $puntuacionTotal = $estudiante->puntuacionTotalEjercicio($ejercicio->id);

        return $this->respondWithSuccess(['puntaje'=>$estudiante->puntuacion,'ejercicio_id'=>$ejercicio->id]);
    }
}

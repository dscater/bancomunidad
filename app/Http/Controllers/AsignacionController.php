<?php

namespace App\Http\Controllers;

use App\Models\Asignacion;
use Illuminate\Http\Request;

class AsignacionController extends Controller
{
    public $validacion = [];

    public $mensajes = [];

    public function index(Request $request)
    {
        $asignacions = Asignacion::all();
        return response()->JSON(['asignacions' => $asignacions, 'total' => count($asignacions)], 200);
    }

    public function store(Request $request)
    {
        $request->validate($this->validacion, $this->mensajes);
        $request["fecha_registro"] = date("Y-m-d");
        $asignacion = Asignacion::create(array_map('mb_strtoupper', $request->all()));
        return response()->JSON([
            'sw' => true,
            'asignacion' => $asignacion,
            'msj' => 'El registro se realizó de forma correcta',
        ], 200);
    }

    public function update(Request $request, Asignacion $asignacion)
    {
        $request->validate($this->validacion, $this->mensajes);
        $asignacion->update(array_map('mb_strtoupper', $request->all()));
        return response()->JSON([
            'sw' => true,
            'asignacion' => $asignacion,
            'msj' => 'El registro se actualizó de forma correcta'
        ], 200);
    }

    public function show(Asignacion $asignacion)
    {
        return response()->JSON($asignacion);
    }

    public function destroy(Asignacion $asignacion)
    {
        $asignacion->delete();
        return response()->JSON([
            'sw' => true,
            'msj' => 'El registro se eliminó correctamente'
        ], 200);
    }
}

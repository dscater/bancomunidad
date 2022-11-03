<?php

namespace App\Http\Controllers;

use App\Models\Formulario;
use Illuminate\Http\Request;

class FormularioController extends Controller
{
    public $validacion = [];

    public $mensajes = [];

    public function index(Request $request)
    {
        $formularios = Formulario::all();
        return response()->JSON(['formularios' => $formularios, 'total' => count($formularios)], 200);
    }

    public function store(Request $request)
    {
        $request->validate($this->validacion, $this->mensajes);
        $request["fecha_registro"] = date("Y-m-d");
        $formulario = Formulario::create(array_map('mb_strtoupper', $request->all()));
        return response()->JSON([
            'sw' => true,
            'formulario' => $formulario,
            'msj' => 'El registro se realizó de forma correcta',
        ], 200);
    }

    public function update(Request $request, Formulario $formulario)
    {
        $request->validate($this->validacion, $this->mensajes);
        $formulario->update(array_map('mb_strtoupper', $request->all()));
        return response()->JSON([
            'sw' => true,
            'formulario' => $formulario,
            'msj' => 'El registro se actualizó de forma correcta'
        ], 200);
    }

    public function show(Formulario $formulario)
    {
        return response()->JSON($formulario);
    }

    public function destroy(Formulario $formulario)
    {
        $formulario->delete();
        return response()->JSON([
            'sw' => true,
            'msj' => 'El registro se eliminó correctamente'
        ], 200);
    }
}

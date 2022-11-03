<?php

namespace App\Http\Controllers;

use App\Models\Regional;
use Illuminate\Http\Request;

class RegionalController extends Controller
{
    public $validacion = [];

    public $mensajes = [];

    public function index(Request $request)
    {
        $regionals = Regional::all();
        return response()->JSON(['regionals' => $regionals, 'total' => count($regionals)], 200);
    }

    public function store(Request $request)
    {
        $request->validate($this->validacion, $this->mensajes);
        $request["fecha_registro"] = date("Y-m-d");
        $regional = Regional::create(array_map('mb_strtoupper', $request->all()));
        return response()->JSON([
            'sw' => true,
            'regional' => $regional,
            'msj' => 'El registro se realizó de forma correcta',
        ], 200);
    }

    public function update(Request $request, Regional $regional)
    {
        $request->validate($this->validacion, $this->mensajes);
        $regional->update(array_map('mb_strtoupper', $request->all()));
        return response()->JSON([
            'sw' => true,
            'regional' => $regional,
            'msj' => 'El registro se actualizó de forma correcta'
        ], 200);
    }

    public function show(Regional $regional)
    {
        return response()->JSON($regional);
    }

    public function destroy(Regional $regional)
    {
        $regional->delete();
        return response()->JSON([
            'sw' => true,
            'msj' => 'El registro se eliminó correctamente'
        ], 200);
    }
}

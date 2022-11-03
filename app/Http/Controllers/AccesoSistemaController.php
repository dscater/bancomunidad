<?php

namespace App\Http\Controllers;

use App\Models\AccesoSistema;
use Illuminate\Http\Request;

class AccesoSistemaController extends Controller
{
    public $validacion = [];

    public $mensajes = [];

    public function index(Request $request)
    {
        $acceso_sistemas = AccesoSistema::all();
        return response()->JSON(['acceso_sistemas' => $acceso_sistemas, 'total' => count($acceso_sistemas)], 200);
    }

    public function store(Request $request)
    {
        $request->validate($this->validacion, $this->mensajes);
        $acceso_sistema = AccesoSistema::create(array_map('mb_strtoupper', $request->all()));
        return response()->JSON([
            'sw' => true,
            'acceso_sistema' => $acceso_sistema,
            'msj' => 'El registro se realizó de forma correcta',
        ], 200);
    }

    public function update(Request $request, AccesoSistema $acceso_sistema)
    {
        $request->validate($this->validacion, $this->mensajes);
        $acceso_sistema->update(array_map('mb_strtoupper', $request->all()));
        return response()->JSON([
            'sw' => true,
            'acceso_sistema' => $acceso_sistema,
            'msj' => 'El registro se actualizó de forma correcta'
        ], 200);
    }

    public function show(AccesoSistema $acceso_sistema)
    {
        return response()->JSON($acceso_sistema);
    }

    public function destroy(AccesoSistema $acceso_sistema)
    {
        $acceso_sistema->delete();
        return response()->JSON([
            'sw' => true,
            'msj' => 'El registro se eliminó correctamente'
        ], 200);
    }
}

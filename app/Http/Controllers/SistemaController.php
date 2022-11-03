<?php

namespace App\Http\Controllers;

use App\Models\PerfilSistema;
use App\Models\Sistema;
use Illuminate\Http\Request;

class SistemaController extends Controller
{
    public $validacion = [
        "nombre" => "required",
        "objetivo" => "required",
        "version" => "required",
        "tipo" => "required",
        "fecha_produccion" => "required|date",
        "empresa_proveedora" => "nullable",
    ];

    public $mensajes = [];

    public function index(Request $request)
    {
        $sistemas = Sistema::all();
        return response()->JSON(['sistemas' => $sistemas, 'total' => count($sistemas)], 200);
    }

    public function store(Request $request)
    {
        $request->validate($this->validacion, $this->mensajes);
        $request["fecha_registro"] = date("Y-m-d");
        $sistema = Sistema::create(array_map('mb_strtoupper', $request->all()));
        return response()->JSON([
            'sw' => true,
            'sistema' => $sistema,
            'msj' => 'El registro se realizó de forma correcta',
        ], 200);
    }

    public function update(Request $request, Sistema $sistema)
    {
        $request->validate($this->validacion, $this->mensajes);
        $sistema->update(array_map('mb_strtoupper', $request->all()));
        return response()->JSON([
            'sw' => true,
            'sistema' => $sistema,
            'msj' => 'El registro se actualizó de forma correcta'
        ], 200);
    }

    public function show(Sistema $sistema)
    {
        return response()->JSON($sistema);
    }

    public function destroy(Sistema $sistema)
    {
        $sistema->delete();
        return response()->JSON([
            'sw' => true,
            'msj' => 'El registro se eliminó correctamente'
        ], 200);
    }

    public function getPerfiles(Sistema $sistema)
    {
        $perfiles = PerfilSistema::where("sistema_id", $sistema->id)->get();
        return response()->JSON($perfiles);
    }
}

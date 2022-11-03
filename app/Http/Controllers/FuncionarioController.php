<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use Illuminate\Http\Request;

class FuncionarioController extends Controller
{
    public $validacion = [
        "ci" => "required",
        "nombre" => "required",
        "paterno" => "required",
        "materno" => "required",
        "cargo_id" => "required",
        "regional_id" => "required",
        "agencia_id" => "required",
    ];

    public $mensajes = [];

    public function index(Request $request)
    {
        $funcionarios = Funcionario::all();
        return response()->JSON(['funcionarios' => $funcionarios, 'total' => count($funcionarios)], 200);
    }

    public function store(Request $request)
    {
        $request->validate($this->validacion, $this->mensajes);
        $request["fecha_registro"] = date("Y-m-d");
        $funcionario = Funcionario::create(array_map('mb_strtoupper', $request->all()));
        return response()->JSON([
            'sw' => true,
            'funcionario' => $funcionario,
            'msj' => 'El registro se realizó de forma correcta',
        ], 200);
    }

    public function update(Request $request, Funcionario $funcionario)
    {
        $request->validate($this->validacion, $this->mensajes);
        $funcionario->update(array_map('mb_strtoupper', $request->all()));
        return response()->JSON([
            'sw' => true,
            'funcionario' => $funcionario,
            'msj' => 'El registro se actualizó de forma correcta'
        ], 200);
    }

    public function show(Funcionario $funcionario)
    {
        return response()->JSON($funcionario);
    }

    public function destroy(Funcionario $funcionario)
    {
        $funcionario->delete();
        return response()->JSON([
            'sw' => true,
            'msj' => 'El registro se eliminó correctamente'
        ], 200);
    }
}

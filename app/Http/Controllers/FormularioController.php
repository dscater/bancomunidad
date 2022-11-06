<?php

namespace App\Http\Controllers;

use App\Models\Formulario;
use Illuminate\Http\Request;

class FormularioController extends Controller
{
    public $validacion = [
        "funcionario_id" => "required",
        "tipo_acceso" => "required",
    ];

    public $mensajes = [];

    public function index(Request $request)
    {
        $formularios = Formulario::all();
        return response()->JSON(['formularios' => $formularios, 'total' => count($formularios)], 200);
    }

    public function store(Request $request)
    {
        if (isset($request->tipo_acceso) && $request->tipo_acceso != "") {
            if ($request->tipo_acceso == "ALTO DE ACCESO") {
                $this->validacion["cargo_id"] = "required";
                unset($request["agencia_origen"]);
                unset($request["agencia_destino"]);
            } else {
                $this->validacion["agencia_origen"] = "required";
                $this->validacion["agencia_destino"] = "required";
                unset($request["cargo_id"]);
            }
        }

        $request->validate($this->validacion, $this->mensajes);
        $request["codigo"] = Formulario::ultimoCodigo();
        $request["fecha_registro"] = date("Y-m-d");
        if (!$request->fecha_solicitud) {
            unset($request["fecha_solicitud"]);
        }
        if (!$request->fecha_respuesta) {
            unset($request["fecha_respuesta"]);
        }

        if (!$request->hora_solicitud) {
            unset($request["hora_solicitud"]);
        }
        if (!$request->hora_respuesta) {
            unset($request["hora_respuesta"]);
        }
        $formulario = Formulario::create(array_map('mb_strtoupper', $request->all()));

        return response()->JSON([
            'sw' => true,
            'formulario' => $formulario,
            'msj' => 'El registro se realizó de forma correcta',
        ], 200);
    }

    public function update(Request $request, Formulario $formulario)
    {
        if (isset($request->tipo_acceso) && $request->tipo_acceso != "") {
            if ($request->tipo_acceso == "ALTO DE ACCESO") {
                $this->validacion["cargo_id"] = "required";
                unset($request["agencia_origen"]);
                unset($request["agencia_destino"]);
            } else {
                $this->validacion["agencia_origen"] = "required";
                $this->validacion["agencia_destino"] = "required";
                unset($request["cargo_id"]);
            }
        }

        if (!$request->fecha_solicitud) {
            unset($request["fecha_solicitud"]);
        }
        if (!$request->fecha_respuesta) {
            unset($request["fecha_respuesta"]);
        }

        if (!$request->hora_solicitud) {
            unset($request["hora_solicitud"]);
        }
        if (!$request->hora_respuesta) {
            unset($request["hora_respuesta"]);
        }

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

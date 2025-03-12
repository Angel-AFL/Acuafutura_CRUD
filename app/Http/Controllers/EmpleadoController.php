<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;

class EmpleadoController extends Controller
{

    public function index()
    {
        $empleados = Empleado::all();
        return response()->json($empleados);
    }

    public function store(Request $request)
    {
        $empleado = Empleado::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'edad' => $request->edad,
            'correo' => $request->correo,
            'id_users' => auth()->id() // Asigna el ID del usuario autenticado
        ]);

        return response()->json($empleado);
    }

    public function show($id)
    {
        $empleado = Empleado::findOrFail($id);
        return response()->json($empleado);
    }

    public function update(Request $request, $id)
    {
        $empleado = Empleado::findOrFail($id);
        $empleado->update($request->all());
        return response()->json('Empleado actualizado con éxito');
    }

    public function destroy($id)
{
    $empleado = Empleado::findOrFail($id);
    $empleado->delete();
    return response()->json(['success' => 'Empleado eliminado']);
}

    public function apiVerEmpleados()
    {
        $empleados = Empleado::all();
        $data = [
            'message' => 'Listado de empleados',
            'empleados' => $empleados,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    public function apiCrearEmpleado(Request $request){
        $empleados = Empleado::create($request->all());
        $data = [
            'message' => 'Empleado creado',
            'empleado' => $empleados,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    public function apiVerEmpleado($id){
        $empleado = Empleado::find($id);
        if(!$empleado){
            $data = [
                'message' => 'Empleado no encontrado',
                'status' => 404
            ];
            return response()->json($data, 200);
        }
        $data = [
            'empleado' => $empleado,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function apiEditarEmpleado(Request $request, Empleado $id){
        $empleado = Empleado::find($id);
        if($request->has('nombre')){
            $empleado->nombre = $request->nombre;
        }
        $data = [
            'message' => 'Empleado actualizado',
            'empleado' => $empleado,
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}
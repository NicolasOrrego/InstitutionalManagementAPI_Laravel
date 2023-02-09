<?php

namespace App\Http\Controllers\Directora\Alumno;

use App\Http\Controllers\Controller;
use App\Models\Alumno;
use Illuminate\Http\Request;

class AlumnoConntroller extends Controller
{
    //TODO: Crear nuevo curso
    public function crearAlumno(Request $request)
    {
        $validacion_datos = $request->validate([
            'id_apoderado' => 'required|max:30|min:1',
            'id_curso' => 'required|max:30|min:1',
            'nombres' => 'required|max:30|min:3',
            'apellidos' => 'required|max:30|min:3',
            'fecha_nac' => 'required',
        ], [
            //! VALIDACIONES
            'id_apoderado.required' => 'El campo apoderado es requerido',
            'id_curso.required' => 'El campo curso es requerido',
            'nombres.required' => 'El campo nombre es requerido',
            'apellidos.required' => 'El campo apellidos es requerido',
            'fecha_nac.required' => 'El campo fecha de nacimiento es requerido',
        ]);

        $alumno = $validacion_datos;
        $alumno = Alumno::create($alumno);

        return response()->json([
            'message' => 'Alumno registrado exitosamente',
            'alumno' => $alumno
        ], 200);
    }

    //TODO: Obtener todos los cursos
    public function obtenerAlumnos(Request $request)
    {
        $alumnos = Alumno::all();
        if ($alumnos->count() > 0) {
            return response()->json([
                'alumnos' => $alumnos
            ], 200);
        } else {
            return response()->json([
                'message' => 'No hay alumnos registrados.'
            ], 200);
        }
    }

    //TODO: Buscar curso
    public function buscarAlumno(Request $request, $id)
    {
        $alumno = Alumno::find($id);
        if ($alumno) {
            return response()->json([
                'message' => 'Alumno encontrado',
                'alumno' => $alumno
            ], 200);
        } else {
            return response()->json([
                'message' => 'Alumno no encontrado'
            ], 404);
        }
    }

    //TODO: Modificar curso
    public function modificarAlumno(Request $request, $id)
    {
        $validacion_datos = $request->validate([
            'id_apoderado' => 'required|max:30|min:1',
            'id_curso' => 'required|max:30|min:1',
            'nombres' => 'required|max:30|min:3',
            'apellidos' => 'required|max:30|min:3',
            'fecha_nac' => 'required',
        ], [
            //! VALIDACIONES
            'id_apoderado.required' => 'El campo apoderado es requerido',
            'id_curso.required' => 'El campo curso es requerido',
            'nombres.required' => 'El campo nombre es requerido',
            'apellidos.required' => 'El campo apellidos es requerido',
            'fecha_nac.required' => 'El campo fecha de nacimiento es requerido',
        ]);

        $alumno = Alumno::find($id);
        if (!$alumno) {
            return response()->json(['error' => 'El alumno no existe'], 404);
        }
        $alumno->update($validacion_datos);
        return response()->json(['message' => 'Alumno modificado exitosamente', 'alumno' => $alumno], 200);
    }

    //TODO: Eliminar curso
    public function eliminarAlumno($id)
    {
        $alumno = Alumno::find($id);
        if (!$alumno) {
            return response()->json(['error' => 'El alumno no existe'], 404);
        }
        $alumno->delete();
        return response()->json(['message' => 'Alumno eliminado exitosamente'], 200);
    }
}

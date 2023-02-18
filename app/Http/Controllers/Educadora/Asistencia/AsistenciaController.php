<?php

namespace App\Http\Controllers\Educadora\Asistencia;

use App\Models\Asistencia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AsistenciaController extends Controller
{
      //TODO: Crear nueva asistencia
      public function crearAsistencia(Request $request)
      {
          $request->validate([
              'id_curso' => 'required|exists:cursos,id',
              'fecha' => 'required|date',
              'estado.*' => 'required|in:Ausente,Presente',
              'id_alumno.*' => 'required|exists:alumnos,id',
          ]);
  
          $asistencia = Asistencia::where('id_curso', $request->id_curso)
              ->where('fecha', $request->fecha)
              ->first();
          if ($asistencia) {
              return response()->json([
                  'message' => 'La asistencia para este curso en esta fecha ya ha sido registrada.'
              ], 400);
          }
  
          foreach ($request->estado as $key => $value) {
              Asistencia::create([
                  'id_user' => auth()->user()->id,
                  'id_curso' => $request->id_curso,
                  'fecha' => $request->fecha,
                  'id_alumno' => $request['id_alumno'][$key],
                  'estado' => $value,
              ]);
          }
  
          return response()->json([
              'message' => 'Asistencia registrada exitosamente'
          ]);
      }
  
      //TODO: Obtener todos las asistencias
      public function obtenerAsistencias(Request $request)
      {
          $asistencias = Asistencia::all();
  
          if ($asistencias->count() > 0) {
              return response()->json([
                  'asistencias' => $asistencias
              ], 200);
          } else {
              return response()->json([
                  'message' => 'No hay asistencias registradas.'
              ], 200);
          }
      }
  
      //TODO: Buscar asistencia 
      public function buscarAsistencia(Request $request, $fecha, $id_curso)
      {
          $asistencias = Asistencia::where('fecha', $fecha)
              ->where('id_curso', $id_curso)
              ->get();
  
          return response()->json([
              'asistencias' => $asistencias
          ], 200);
      }
  
}

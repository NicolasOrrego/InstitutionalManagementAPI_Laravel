<?php

namespace App\Http\Controllers\Directora\Asistencia;

use App\Http\Controllers\Controller;
use App\Models\Asistencia;
use Illuminate\Http\Request;

class AsistenciaController extends Controller
{
    public function crearAsistencia(Request $request)
    {
        $validacion_datos = $request->validate([
            'fecha' => 'required|date_format:Y-m-d',
            'hora' => 'required|date_format:H:i',
            'motivo' => 'required|max:60|min:3',
            ''
        ], [
            //! VALIDACIONES
            'fecha.required' => 'El campo de fecha es requerido.',
            'fecha.date_format' => 'El formato de fecha no es valido',
            'hora.date_format' => 'El formato de hora no es valida',
            'motivo.required' => 'El campo motivo es requerido',
        ]);

        $usuario = auth()->user();
        $existe_cita = Asistencia::where('fecha', $request->fecha)
            ->where('hora', $request->hora)->first();

        if ($existe_cita) {
            return response()->json(['error' => 'La hora esta siendo ocupada'], 404);
        }

        if ($usuario->roles !== "Cliente" || $usuario->estado !== "Habilitado") {
            return response()->json(['error' => 'El usuario cliente seleccionado no se encuentra habilitado'], 403);
        }

        $cita_medica = $validacion_datos;
        $cita_medica['fecha'] = $request->fecha;
        $cita_medica['hora'] = $request->hora;
        $cita_medica['id_usuario'] = $usuario->id;
        $cita_medica = Asistencia::create($cita_medica);
        return response()->json([
            'message' => 'Cita médica registrada exitosamente',
            'cita_medica' => $cita_medica
        ], 200);
    }
}

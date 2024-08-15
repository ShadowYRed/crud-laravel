<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // Para manejar la petición HTTP

class EstudianteController extends Controller
{
    // Método para agregar estudiantes desde la API
    public function agregarEstudiantes()
    {
        // Realizar la petición a la API para obtener los 5 estudiantes
        $response = Http::get('https://randomuser.me/api/', [
            'results' => 5,
            'nat' => 'us' // Puedes ajustar la nacionalidad si es necesario
        ]); 

        $estudiantes = $response->json()['results'];

        $nombres = [];

        foreach ($estudiantes as $estudianteData) {
            // Crear y guardar cada estudiante en la base de datos
            $estudiante = new Estudiante();
            $nombreCompleto = $estudianteData['name']['first'] . ' ' . $estudianteData['name']['last'];
            $estudiante->nombre = $nombreCompleto;
            $estudiante->apellido = $estudianteData['name']['last'];
            $estudiante->email = $estudianteData['email'];
            $estudiante->save();

            $nombres[] = $nombreCompleto;
        }

        // Concatenar todos los nombres en un solo string
        $nombresString = implode(' ', $nombres);

        // Calcular la letra más repetida
        $letraMasRepetida = $this->calcularLetraMasRepetida($nombresString);

        // Generar el mensaje de éxito
        $mensaje = 'Se agregaron con éxito los siguientes estudiantes: ' . implode(', ', $nombres) . 
                   '. La letra más repetida en los nombres es: "' . $letraMasRepetida . '".';

        return redirect()->route('notas.index')->with('success', $mensaje);
    }

    // Función para calcular la letra más repetida
    private function calcularLetraMasRepetida($cadena)
    {
        $cadena = strtolower(preg_replace('/[^a-z]/', '', $cadena)); // Eliminar todo excepto letras y convertir a minúsculas
        $letras = count_chars($cadena, 1);
        arsort($letras);
        return chr(array_key_first($letras));
    }
}

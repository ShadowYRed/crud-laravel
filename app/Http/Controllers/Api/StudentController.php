// App/Http/Controllers/StudentController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Estudiante;

class StudentController extends Controller
{
    public function add()
    {
        // Llamada a la API para obtener los 5 usuarios
        $response = Http::get('https://randomuser.me/api/?results=5');
        $data = $response->json();

        // Obtener los nombres completos
        $nombres = array_column($data['results'], 'name');
        $nombresCompletos = array_map(function ($nombre) {
            return $nombre['first'] . ' ' . $nombre['last'];
        }, $nombres);

        // Encontrar la letra más repetida en los nombres
        $letraMasRepetida = $this->encontrarLetraMasRepetida($nombresCompletos);

        // Guardar los datos en la base de datos
        foreach ($data['results'] as $usuario) {
            Estudiante::create([
                'nombre' => $usuario['name']['first'],
                'apellido' => $usuario['name']['last'],
                'email' => $usuario['email'],
            ]);
        }

        // Redirigir a la vista con los resultados
        return view('students.add', [
            'nombres' => $nombresCompletos,
            'letraMasRepetida' => $letraMasRepetida,
        ]);
    }

    // Método para encontrar la letra más repetida en los nombres
    private function encontrarLetraMasRepetida($nombres)
    {
        $texto = implode('', $nombres);
        $texto = strtolower(preg_replace('/[^a-z]/', '', $texto)); // Eliminar caracteres no alfabéticos
        $frecuencias = array_count_values(str_split($texto));

        arsort($frecuencias); // Ordenar en orden descendente

        $letraMasRepetida = key($frecuencias);
        return $letraMasRepetida;
    }
}

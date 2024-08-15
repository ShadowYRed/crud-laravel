<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RandomUserController extends Controller
{
    public function fetchAndAnalyzeNames()
    {
        // Obtener 5 personas desde el API externo
        $response = Http::get('https://randomuser.me/api/', [
            'results' => 5
        ]);

        // Decodificar la respuesta JSON
        $data = $response->json();
        $users = $data['results'];

        // Obtener los nombres completos
        $names = array_map(function($user) {
            return $user['name']['first'] . ' ' . $user['name']['last'];
        }, $users);

        // Concatenar todos los nombres en una sola cadena
        $allNames = implode(' ', $names);

        // Contar la frecuencia de cada letra
        $letterFrequency = array_count_values(str_split(preg_replace('/\s+/', '', strtolower($allNames))));

        // Encontrar la letra más frecuente
        arsort($letterFrequency);
        $mostFrequentLetter = key($letterFrequency);

        // Retornar el resultado
        return response()->json([
            'names' => $names,
            'most_frequent_letter' => $mostFrequentLetter,
            'letter_frequency' => $letterFrequency
        ]);
    }
}

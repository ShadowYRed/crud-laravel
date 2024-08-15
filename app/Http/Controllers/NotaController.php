<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use App\Models\Estudiante;
use App\Models\Materia;
use Illuminate\Http\Request;

class NotaController extends Controller
{
    public $timestamps = true;
    public function index()
    {
        $notas = Nota::with('estudiante', 'materia')->get();
        $promedios = Nota::selectRaw('estudiante_id, AVG(nota) as promedio')
                        ->groupBy('estudiante_id')
                        ->get()
                        ->mapWithKeys(function ($item) {
                            return [$item->estudiante_id => $item->promedio];
                        });

        $estudiantes = Estudiante::all();

        // Depuración: Verificar los datos
        // dd($notas, $promedios, $estudiantes);

        return view('notas.index', compact('notas', 'promedios', 'estudiantes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $estudiantes = Estudiante::all();
        $materias = Materia::all();
        return view('notas.create', compact('estudiantes', 'materias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'estudiante_id' => 'required|exists:estudiantes,id',
            'materia_id' => 'required|exists:materias,id',
            'nota' => 'required|numeric|min:0|max:100',
        ]);

        // Crear una nueva nota en la base de datos
        Nota::create($validated);

        // Redirigir al usuario con un mensaje de éxito
        return redirect()->route('notas.index')->with('success', 'Nota creada con éxito.');
    }

    public function edit($id)
    {
        $nota = Nota::findOrFail($id);
        $estudiantes = Estudiante::all();
        $materias = Materia::all();
        return view('notas.edit', compact('nota', 'estudiantes', 'materias'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nota' => 'required|numeric|between:0,100',
            'estudiante_id' => 'required|exists:estudiantes,id',
            'materia_id' => 'required|exists:materias,id',
        ]);

        $nota = Nota::findOrFail($id);
        $nota->update($request->all());

        if ($request->ajax()) {
            return response()->json(['message' => 'Nota actualizada con éxito.']);
        }

        return redirect()->route('notas.index')->with('success', 'Nota actualizada con éxito.');
    }


    public function destroy($id)
    {
        $nota = Nota::findOrFail($id);
        $nota->delete();

        if (request()->ajax()) {
            return response()->json(['message' => 'Nota eliminada con éxito.']);
        }

        return redirect()->route('notas.index')->with('success', 'Nota eliminada con éxito.');
    }
}

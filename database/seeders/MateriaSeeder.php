<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Materia;

class MateriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Materia::create([
            'nombre' => 'Matemáticas',
            'descripcion' => 'Curso básico de matemáticas',
        ]);
    }
}

<?php

use Illuminate\Support\Facades\Route;
// routes/web.php

use App\Http\Controllers\NotaController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\EstudianteController;

Route::get('/agregar-estudiantes', [EstudianteController::class, 'agregarEstudiantes'])->name('agregar.estudiantes');
Route::resource('notas', NotaController::class);
Route::get('students/add', [StudentController::class, 'add'])->name('students.add');
Route::get('/', function () {
    return redirect()->route('notas.index');
});

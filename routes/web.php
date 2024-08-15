<?php

use Illuminate\Support\Facades\Route;
// routes/web.php

use App\Http\Controllers\NotaController;
use App\Http\Controllers\StudentController;

Route::resource('notas', NotaController::class);
Route::get('students/add', [StudentController::class, 'add'])->name('students.add');
Route::get('/', function () {
    return redirect()->route('notas.index');
});

<!-- resources/views/notas/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 5rem">
    <!-- Botones para agregar nota y estudiantes -->
    <div class="mb-3">
        <a href="{{ route('notas.create') }}" class="btn btn-primary">Agregar Nota</a>
        <a href="{{ route('students.add') }}" class="btn btn-secondary">Agregar Estudiantes</a>
    </div>

    <!-- Mensaje de éxito, si existe -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tabla de Notas -->
    <h2>Notas Registradas</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Estudiante</th>
                <th>Materia</th>
                <th>Nota</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($notas as $nota)
                <tr>
                    <td>{{ $nota->estudiante->nombre }}</td>
                    <td>{{ $nota->materia->nombre }}</td>
                    <td>{{ $nota->nota }}</td>
                    <td>{{ $nota->created_at ? $nota->created_at->format('d/m/Y') : 'No disponible' }}</td>
                    <td>
                        <a href="{{ route('notas.edit', $nota->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('notas.destroy', $nota->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Mostrar los promedios de los estudiantes -->
    <h3>Promedios de Estudiantes</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Estudiante</th>
                <th>Promedio</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($promedios as $estudianteId => $promedio)
                @php
                    $estudiante = $estudiantes->find($estudianteId);
                @endphp
                <tr>
                    <td>{{ $estudiante ? $estudiante->nombre : 'Desconocido' }}</td>
                    <td>{{ number_format($promedio, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Tabla de Todos los Estudiantes -->
    <h3>Todos los Estudiantes</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Fecha de Creación</th>
                <th>Fecha de Actualización</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($estudiantes as $estudiante)
                <tr>
                    <td>{{ $estudiante->id }}</td>
                    <td>{{ $estudiante->nombre }}</td>
                    <td>{{ $estudiante->apellido }}</td>
                    <td>{{ $estudiante->email }}</td>
                    <td>{{ $estudiante->created_at ? $estudiante->created_at->format('d/m/Y') : 'No disponible' }}</td>
                    <td>{{ $estudiante->updated_at ? $estudiante->updated_at->format('d/m/Y') : 'No disponible' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

<!-- resources/views/notas/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Nota</h1>
    <form action="{{ route('notas.update', $nota->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="estudiante_id">Estudiante</label>
            <select name="estudiante_id" id="estudiante_id" class="form-control @error('estudiante_id') is-invalid @enderror">
                @foreach($estudiantes as $estudiante)
                    <option value="{{ $estudiante->id }}" {{ $estudiante->id == $nota->estudiante_id ? 'selected' : '' }}>
                        {{ $estudiante->nombre }}
                    </option>
                @endforeach
            </select>
            @error('estudiante_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="materia_id">Materia</label>
            <select name="materia_id" id="materia_id" class="form-control @error('materia_id') is-invalid @enderror">
                @foreach($materias as $materia)
                    <option value="{{ $materia->id }}" {{ $materia->id == $nota->materia_id ? 'selected' : '' }}>
                        {{ $materia->nombre }}
                    </option>
                @endforeach
            </select>
            @error('materia_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="nota">Nota</label>
            <input type="number" name="nota" id="nota" class="form-control @error('nota') is-invalid @enderror" value="{{ old('nota', $nota->nota) }}" required>
            @error('nota')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Nota</button>
        <a href="{{ route('notas.index') }}" class="btn btn-secondary">Regresar</a>
    </form>
</div>
@endsection

<?php
<!-- resources/views/students/add.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Agregar Estudiantes</h1>

    <!-- Mostrar los resultados de la API -->
    @if(isset($nombres) && isset($letraMasRepetida))
        <div class="alert alert-info">
            <p><strong>Nombres obtenidos:</strong></p>
            <ul>
                @foreach ($nombres as $nombre)
                    <li>{{ $nombre }}</li>
                @endforeach
            </ul>

            <p><strong>Letra más repetida en los nombres:</strong> {{ strtoupper($letraMasRepetida) }}</p>
        </div>
    @endif

    <!-- Botón para agregar estudiantes desde la API -->
    <form action="{{ route('students.add') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">Agregar Estudiantes desde API</button>
    </form>
</div>
@endsection

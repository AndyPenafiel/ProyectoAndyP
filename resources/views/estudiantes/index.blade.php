@php
    $contador = 1;
@endphp

@extends('layouts.app')

@section('content')

    <div class="panel-heading text-center" style="background:#d9edf7 ;">Administracion de Estudiantes
        
    </div>
    <br>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <form class="form-inline my-2 my-lg-0 " action="{{ route('buscar_estudiantes')}}">
            <input class="form-control mr-sm-2" type="search" placeholder="Apellidos/Cedula" aria-label="Search" name="buscar">
            <button class="btn btn-success btn-sm" type="submit" style="height: 35px; line-height: 1.2;">
                <span class="material-symbols-outlined">
                    search
                    </span>
            </button>
        </form>
    </div>
                
    
    <br>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Matricula</th>
                <th>Apellidos</th>
                <th>Nombres</th>
                <th>Cedula</th>
                <th>Curso</th>
                <th>Paralelo</th>
                <th>Especialidad</th>
                <th>Paralelo Esp</th>
            </tr>
        </thead>
        <tbody>
            @foreach($estudiantes as $e)
                <tr>
                    <td>{{ $contador }}</td>
                    <td>{{ $e->mat_id }}</td>
                    <td>{{ $e->est_apellidos }}</td>
                    <td>{{ $e->est_nombres }}</td>
                    <td>{{ $e->est_cedula }}</td>
                    <td>{{ $e->cur_descripcion }}</td>
                    <td>{{ $e->mat_paralelo }}</td>
                    <td>{{ $e->esp_descripcion }}</td>
                    <td>{{ $e->mat_paralelot }}</td>
                </tr>
                @php
                    $contador++;
                @endphp
            @endforeach
        </tbody>
    </table>
@endsection

@php
$contador = 1;
@endphp
@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <form class="form-inline my-2 my-lg-0 " action="{{ route('buscar_estudiante_orden')}}">
        <input class="form-control mr-sm-2" type="search" placeholder="Apellidos/Cedula" aria-label="Search" name="buscar">
        <button class="btn btn-success btn-sm" type="submit" style="height: 35px; line-height: 1.2;">
            <span class="material-symbols-outlined">
                search
            </span>
        </button>
        <input type="hidden" name="secuencial" value="{{$sec}}">
    </form>
</div>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Codigo</th>
            <th>Cedula</th>
            <th>Estudiante</th>
            <th>Curso</th>
            <th>Estado</th>
            <th>Valor</th>
            <th>Documento</th>
        </tr>
    </thead>
    <tbody>
        @forelse($estudiantes as $e)
        <tr> <!-- Agregué la etiqueta <tr> para cada fila -->
            <td>{{ $loop->iteration }}</td>
            <td>{{ $e->codigo }}</td>
            <td>{{ $e->est_cedula }}</td>
            <td>{{ $e->est_apellidos }} {{ $e->est_nombres }}</td>
            <td>{{ $e->jor_descripcion.'/'.$e->esp_descripcion.'/'.$e->cur_descripcion }}</td>
            <td>{{ $e->estado==0 ? 'PENDIENTE' : 'PAGADO' }}</td>
            <td>{{ $e->valor_pagado }}</td>
            <td>{{ $e->documento }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="8">
                <div class="alert alert-danger">NO EXISTEN ESTUDIANTES PARA ÉSTA BÚSQUEDA</div>
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection

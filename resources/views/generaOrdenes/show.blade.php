@extends('layouts.app')
@section('content')

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
<br>
<div class="container-fluid">
     <div class="text-center bg-success text-white">ORDENES INDIVIDUALES</div>
<table class="table border border-success ">

    
    <tr class="">
        <th>#</th>
        <th>Codigo</th>
        <th>Cedula</th>
        <th>Estudiante</th>
        <th>Curso</th>
        <th>Estado</th>
        <th>Valor</th>
        <th>Documento</th>
    </tr>
    @foreach ($ordenes as $o)
       <tr>
          <td>{{ $loop->iteration }}</td> 
          <td>{{ $o->codigo }}</td>
          <td>{{ $o->est_cedula }}</td>
          <td>{{ $o->est_apellidos }} {{ $o->est_nombres }}  </td>
          <td>{{ $o->jor_descripcion.'/'.$o->esp_descripcion.'/'.$o->cur_descripcion }}</td>
          <td>{{ $o->estado==0?'PENDIENTE':'PAGADO' }} </td>
          <td>{{ $o->valor_pagado }}</td>
          <td>{{ $o->documento }}</td>
        </tr> 
    @endforeach
</table>
</div>

@endsection

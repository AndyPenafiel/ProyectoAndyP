@extends('layouts.app')
@section('content')
@php

@endphp
<script>
    $(document).on("click", ".btn_delete", function() {
        if (confirm("¿Seguro desea eliminar?")) {
            const secuencial = $(this).attr("secuencial");
            $("#secuencial").val(secuencial);
            $("#frmEliminar").submit();
        }
    })
</script>
<form action="{{ route('eliminarOrden') }}" method="POST" id="frmEliminar">
    @csrf
    <input type="hidden" name="secuencial" id="secuencial" value="0">
</form>

<div class="container">
    <h3 class="text-center bg-success text-white">Generar Órdenes</h3>

    <form action="{{ route('generarOrdenes') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <select name="anl_id" id="anl_id" class="form-control">
                        @foreach ($periodos as $p)
                            <option value="{{ $p->id }}">{{ $p->anl_descripcion }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <select name="jor_id" id="jor_id" class="form-control">
                        @foreach ($jornadas as $j)
                            <option value="{{ $j->id }}">{{ $j->jor_descripcion }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <select name="mes" id="mes" class="form-control">
                        @foreach ($meses as $key => $m)
                            <option value="{{ $key }}">{{ $m }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-default text-white">Generar</button>
            </div>
        </div>
    </form>

    <table class="table border border-success">
        <thead class="bg-success border border-white">
            <tr>
                <th colspan="6" class="text-center  text-white p-2" >Ordenes Generadas</th>
            </tr>
        </thead>
            <tr class="p-1">
                <th>Secuencial</th>
                <th>Fecha</th>
                <th>Año Lectivo</th>
                <th>Jornada</th>
                <th>Mes</th>
                <th>Acciones</th>
            </tr>
        @foreach ($ordenes as $o)
            <tr>
                <td>{{ $o->secuencial }}</td>
                <td>{{ $o->fecha_registro }}</td>
                <td>{{ $o->anl_descripcion }}</td>
                <td>{{ $o->jor_descripcion }}</td>
                <td>{{ ($o->nombre_mes) }}</td>
                <td>
                    <a href="{{ route('genera_ordenes.show', $o->secuencial) }}" class="btn text-white btn-primary btn-xs py-0 px-2">
                        <span class="material-symbols-outlined">visibility</span>
                    </a>
                    <a href="{{ route('genera_ordenes.xls', $o->secuencial) }}" class="btn text-white btn-success btn-xs py-0 px-2">
                        <span class="material-symbols-outlined">download</span>
                    </a>
                    <form action="{{ route('ordenes.destroy', $o->secuencial) }}" method="POST" onsubmit="return confirm('¿Desea eliminar la Orden?')" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn text-white btn-danger btn-xs py-0 px-2">
                            <span class="material-symbols-outlined me-1">delete</span>
                        </button>
                    </form>
                    
                </td>
            </tr>
        @endforeach
    </table>
</div>
@endsection

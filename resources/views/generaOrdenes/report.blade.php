@extends('layouts.app')
@section('content')
@php
$anl_id=null;
$jor_id=null;
$esp_id=null;
$cur_id=null;
$paralelo=null;
if(isset($dt['anl_id'])){
    $anl_id=$dt['anl_id'];
    $jor_id=$dt['jor_id'];
    $esp_id=$dt['esp_id'];
    $cur_id=$dt['cur_id'];
    $paralelo=$dt['paralelo'];
}    

function validarMes($dato) {
    $estado = null;
    $valor = null;
    $doc = null;
    $cls = null;

    if ($dato != null) {
        $mes = explode('&', $dato);
        if (is_array($mes) && count($mes) > 0) {
            $estado = $mes[0];
            $valor = $mes[1];
            $doc = $mes[2];
            if ($estado == 1) {
                $cls = "bg-success";
            }
        }
    }

    return ['estado' => $estado, 'valor' => $valor, 'doc' => $doc, 'cls' => $cls];
}

@endphp
<div class="">
     <div class="text-center bg-success text-white">REPORTE DE PAGO DE PENSIONES</div>  
     <br> 
<div class="mt-2 p-1">
    <form action="{{ route('genera_ordenes.report') }}" method="POST" >
        @csrf
        <div class="container">

            <table>
                <tr>
                    <td>
                        <select name="anl_id" id="anl_id" class="form-control">
                            <option value="">Periodo/Año Lectivo</option>
                            @foreach($periodos as $id => $descripcion)
                                <option value="{{ $id }}" {{ $anl_id == $id ? 'selected' : '' }}>{{ $descripcion }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select name="jor_id" id="jor_id" class="form-control">
                            <option value="">Jornada</option>
                            @foreach($jornadas as $id => $descripcion)
                                <option value="{{ $id }}" {{ $jor_id == $id ? 'selected' : '' }}>{{ $descripcion }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select name="esp_id" id="esp_id" class="form-control">
                            <option value="">Especialidad</option>
                            @foreach($especialidades as $id => $descripcion)
                                <option value="{{ $id }}" {{ $esp_id == $id ? 'selected' : '' }}>{{ $descripcion }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select name="cur_id" id="cur_id" class="form-control">
                            <option value="">Curso</option>
                            @foreach($cursos as $id => $descripcion)
                                <option value="{{ $id }}" {{ $cur_id == $id ? 'selected' : '' }}>{{ $descripcion }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select name="paralelo" id="paralelo" class="form-control">
                            <option value="0">Paralelo</option>
                            @for($i = 0; $i < 7; $i++)
                                <option {{ $paralelo == chr(65 + $i) ? 'selected' : '' }} value="{{ chr(65 + $i) }}">{{ chr(65 + $i) }}</option>
                            @endfor
                        </select>
                    </td>
                    <td>
                        <div class="btn-group" style="display: flex;">
                            <button type="submit" name="btn_buscar" style="margin-right: 5px;" value="btn_mostrar" class="btn btn-default btn-sm"><i class="fa fa-search"></i></button>
                            <button type="submit" name="btn_buscar" style="margin-right: 5px;" value="btn_imprimir" class="btn btn-default btn-sm"> <i class="fa fa-print"></i> </button>
                            <button type="submit" name="btn_buscar" value="btn_exportar" class="btn btn-success btn-sm text-white">XLS</button>
                        </div>                        
                    </td>
                </tr>
            </table>
            

        </div>    
    </form>    
</div>

    @include('generaOrdenes._table')

</div>

@endsection

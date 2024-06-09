@extends('layouts.app')
@section('content')

<div class="container-fluid">
        <div class="text-center bg-success text-white">DOCUMENTO: 000{{ $documentos[0]->secuencial_documento }} / {{ $documentos[0]->nombre_documento }}</div>   
        <div class="table-responsive">
            <table class="table border border-success mt-3" id="tbl_datos">
                <thead class="bg-success">
                    <tr>
                        <th>#</th>
                        <th>Fecha Inicio Proceso</th>
                        <th>Contrapartida</th>
                        <th>Nombre Contrapartida</th>
                        <th>Fecha Proceso</th>
                        <th>Valor Proceso</th>
                        <th>Referencia Adicional</th>
                        <th>Secuencial Cobro</th>
                        <th>Número Comprobante</th>
                        <th>Número Transacción</th>
                        <th>Fecha Registro</th>
                        <th>Responsable</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($documentos as $documento)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $documento->fecha_inicio_proceso }}</td>
                            <td>{{ $documento->contrapartida }}</td>
                            <td>{{ $documento->nombrecontrapartida }}</td>
                            <td>{{ $documento->fechaprocesodate }}</td>
                            <td>{{ $documento->valorprocc }}</td>
                            <td>{{ $documento->referencia_adicional }}</td>
                            <td>{{ $documento->secuencial_cobro }}</td>
                            <td>{{ $documento->numero_comprobante }}</td>
                            <td>{{ $documento->numerotransaccion }}</td>
                            <td>{{ $documento->fecha_registro }}</td>
                            <td>{{ $documento->secuencial_documento }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
</div>
@endsection

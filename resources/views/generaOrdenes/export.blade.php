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

<div class="container-fluid">
     <div id="cont_header">
         <h4>
            REPORTE DE PAGO DE PENSIONES
         </h4>
         <h5>
            {{ $curso_encabezado }} 
            &nbsp;
            &nbsp;
            &nbsp;
            <small>
                Impreso: {{ date('d/M/Y H:s') }}
            </small>
        </h5>
    </div>

    @include('generaOrdenes._table')

</div>



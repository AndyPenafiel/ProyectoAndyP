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

<style>
    /* page */
    html { font: 16px/1 'Open Sans', sans-serif; overflow: auto; padding: 0.5in; }
    html { background: #999; cursor: default; }
    body { box-sizing: border-box;margin: 0 auto; overflow: hidden; padding: 0.15in;}
    body { background: #FFF; border-radius: 1px; box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5); }
    body { width: 11.7in;height:auto;}
    /* Diseño propio de la hoja */
    table{
        border-collapse:collapse; 
        font-size:10px; 
        width:100%; 
    }
    table th{
        background:#eee; 
    }
    table tr td,th{
      border:solid 1px #ccc; 
      padding:5px; 
    }
    #cont_header h4{
        text-align:center; 
    }
    #cont_header h5{
        text-align:right; 
    }
    /* cuando vayamos a imprimir ... */
    @media print{
      *{ -webkit-print-color-adjust: exact; }
      html{ background: none; padding: 0; }
      body{ box-shadow: none; margin: 0; }
    }
    @page { margin: 0;}
    
    </style>  


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



<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use DB;

class PensionesExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $datos;
    protected $encabezado;

    public function __construct($datos,$encabezado){

       $this->datos=$datos;
       $this->encabezado=$encabezado;

    }

    public function view():View
    {

        return view('generaOrdenes.export')
        ->with('datos',$this->datos)
        ->with('curso_encabezado',$this->encabezado)
        ;  

    }

}

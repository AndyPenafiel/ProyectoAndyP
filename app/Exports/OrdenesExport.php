<?php

namespace App\Exports;

use App\Models\GeneraOrdenes;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class OrdenesExport implements FromView,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
    protected $datos;

    public function __construct($datos)
    {
        $this->datos = $datos;
    }    
    
    
    public function view():view
    {
       
        return view('generaOrdenes.index_excel')
        ->with('datos',$this->datos) ;
    }
}

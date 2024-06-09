<?php

namespace App\Imports;

use App\Models\OrdenesDocumentoBanco;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Auth;

class OrdenesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    use Importable;
    private $sec;
    private $n_documento;

    public function __construct($sec,$n_documento)
    {
        $this->sec = $sec;
        $this->n_documento = $n_documento;
    }
   
    public function model(array $row)
    {
        $sec=$this->sec;
        $fecha_registro=date('Y-m-d H:i:s');
        $responsable=Auth::user()->usr_usuario;

        $existingRecord = OrdenesDocumentoBanco::where('contrapartida', $row['contrapartida'])
            ->where('nombrecontrapartida', $row['nombrecontrapartida'])
            ->where('referencia_adicional', $row['referencia_adicional'])
            ->first();

        if ($existingRecord) {
            // Si el registro ya existe, no lo insertamos de nuevo
            return null;
        }

        return new OrdenesDocumentoBanco([
            'fecha_inicio_proceso'=>$row['fecha_inicio_proceso'],
            'contrapartida'=>$row['contrapartida'],
            'nombrecontrapartida'=>$row['nombrecontrapartida'],
            'fechaprocesodate'=>$row['fechaprocesodate'],
            'valorprocc'=>$row['valorprocc'],
            'referencia_adicional'=>$row['referencia_adicional'],
            'secuencial_cobro'=>$row['secuencial_cobro'],
            'numero_comprobante'=>$row['numero_comprobante'],
            'numerotransaccion'=>$row['numerotransaccion'],
            'nombre_documento'=>$this->n_documento,
            'fecha_registro'=>$fecha_registro,
            'secuencial_documento'=>$sec,
            'responsable'=>$responsable            
        ]);

    }
    
    public function headingRow(): int
    {
        return 5; // La fila que contiene los encabezados de las columnas
    }    
    
}

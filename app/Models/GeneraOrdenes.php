<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneraOrdenes extends Model
{
    protected $table='ordenes_generadas';
    protected $primaryKey='ord_id';
    public $timestamps= false ;
    protected $fillable = [
        'mat_id',
        'fecha_registro',
        'mes',
        'codigo',
        'valor_pagar',
        'fecha_pago',
        'tipo',
        'estado',
        'responsable',
        'obs',
        'identificador',
        'motivo',
        'vpagado',
        'f_acuerdo',
        'ac_no',
        'especial_code',
        'secuencial',
        'numero_documento'
    ];

    

    use HasFactory;
}

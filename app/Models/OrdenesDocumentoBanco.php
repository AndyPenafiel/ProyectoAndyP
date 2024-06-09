<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenesDocumentoBanco extends Model
{
    use HasFactory;
    
    protected $table = 'ordenes_documento_banco';
    protected $primaryKey = 'odb_id';
    public $timestamps = false;    
    protected $fillable = [
        'fecha_inicio_proceso',
        'contrapartida',
        'nombrecontrapartida',
        'fechaprocesodate',
        'valorprocc',
        'referencia_adicional',
        'secuencial_cobro',
        'numero_comprobante',
        'numerotransaccion',
        'nombre_documento',
        'fecha_registro',
        'secuencial_documento',
        'responsable'
    ];
    
    
    
}

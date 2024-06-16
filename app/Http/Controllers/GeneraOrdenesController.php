<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GeneraOrdenes;
use App\Models\OrdenesDocumentoBanco;
use App\Imports\OrdenesImport;
use App\Exports\OrdenesExport;
use App\Exports\PensionesExport;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use Auth;
use Session;





use Illuminate\Support\Facades\URL;

  

class GeneraOrdenesController extends Controller
{

    protected $campus;
    public function __construct() {

        $this->middleware(function ($request, $next) {
            $connection = Session::get('suc_id');
            if ($connection == 1) {
                DB::setDefaultConnection('pgsql');
                $this->campus='G';
            } else {
                $this->campus='C';
                DB::setDefaultConnection('pgsql2');
            }
            return $next($request);
        });

    }           



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $rq)
    {

           // dd(bcrypt('ellanoteama'));
        DB::statement("SET lc_time TO 'es_ES';");
        $periodos=DB::select("SELECT * FROM aniolectivo where anl_selected=1 order by id");
        $jornadas=DB::select("SELECT * FROM jornadas WHERE (id=1 or id=3)");
        $ordenes=DB::select("SELECT o.secuencial,
                            o.fecha_registro,
                            j.jor_descripcion,
                            o.mes,
                            to_char(to_date(o.mes::text, 'MM'), 'TMMonth') AS nombre_mes,
                            a.anl_descripcion
                            FROM ordenes_generadas o
                            JOIN matriculas m ON m.id=o.mat_id
                            JOIN jornadas j ON j.id=m.jor_id
                            JOIN aniolectivo a ON a.id=m.anl_id
                            GROUP BY o.secuencial,
                            o.fecha_registro,
                            j.jor_descripcion,
                            o.mes,
                            a.anl_descripcion
                            ORDER BY o.secuencial
                             ");
        $meses=$this->meses();
        return view('generaOrdenes.index')
        ->with('periodos',$periodos)
        ->with('jornadas',$jornadas)
        ->with('meses',$meses)
        ->with('ordenes',$ordenes)
        ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($sec)
    {
      $ordenes =$this->ordenes_generadas_por_secuencial($sec);
      return view('generaOrdenes.show')
      ->with('ordenes',$ordenes)
      ->with('sec',$sec)
      ;    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($secuencial)
    {
    GeneraOrdenes::where('secuencial', $secuencial)->delete();

    return redirect()->route('ordenes.index');
    }

    public function meses(){
        $meses = [
            '1' => 'ENERO',
            '2' => 'FEBRERO',
            '3' => 'MARZO',
            '4' => 'ABRIL',
            '5' => 'MAYO',
            '6' => 'JUNIO',
            '7' => 'JULIO',
            '8' => 'AGOSTO',
            '9' => 'SEPTIEMBRE',
            '10' => 'OCTUBRE',
            '11' => 'NOVIEMBRE',
            '12' => 'DICIEMBRE',
        ];
        return $meses;
    }
    
    public function mesesLetra($nmes){
        $result = "";
        switch($nmes){
            case 1: $result = "E"; break; 
            case 2: $result = "F"; break; 
            case 3: $result = "M"; break; 
            case 4: $result = "A"; break; 
            case 5: $result = "MY"; break; 
            case 6: $result = "J"; break; 
            case 7: $result = "JL"; break; 
            case 8: $result = "AG"; break; 
            case 9: $result = "S"; break; 
            case 10: $result = "O"; break; 
            case 11: $result = "N"; break; 
            case 12: $result = "D"; break; 
        }
        return $result;
    }
    

    public function generarOrdenes(Request $rq){
        $datos=$rq->all();
        $anl_id=$datos['anl_id']; ///AÑO LECTIVO
        $jor_id=$datos['jor_id']; ////JORNADA
        $mes=$datos['mes']; /////MES
        $nmes=$this->mesesLetra($mes);
        $campus=$this->campus;
        
         $validar=DB::select("SELECT * FROM ordenes_generadas o
                              JOIN  matriculas m ON m.id=o.mat_id  
                              WHERE m.anl_id=$anl_id 
                              AND   m.jor_id=$jor_id 
                              AND   o.mes=$mes 
                            ");

        if(empty($validar)){
          
            $secuenciales=DB::selectone("SELECT max(secuencial) as secuencial from ordenes_generadas");
            $sec=$secuenciales->secuencial+1;
            $estudiantes=DB::select("SELECT *, m.id as mat_id FROM matriculas m 
                                    JOIN estudiantes e ON m.est_id=e.id
                                    JOIN jornadas j ON m.jor_id=j.id
                                    JOIN cursos c ON m.cur_id=c.id
                                    JOIN especialidades es ON m.esp_id=es.id
                                    WHERE m.anl_id=$anl_id 
                                    AND m.jor_id=$jor_id
                                    AND m.mat_estado=1 ");
            $valor_pagar=75;   
            foreach($estudiantes as $e)
            {
                    $input['mat_id']=$e->mat_id;    ///ID de la matricula
                    $input['codigo']=$nmes.$campus.$e->jor_obs.$e->cur_obs.$e->esp_obs.'-'.$e->mat_id;          ///MGM3IN-6546
                    $input['fecha_registro']=date('Y-m-d');  
                    $input['valor_pagar']=$valor_pagar;
                    $input['fecha_pago']=null;
                    $input['valor_pagado']=0;
                    $input['estado']=0;  ///Pendiente ->0 Pagado ->1
                    $input['mes']=$mes;
                    $input['responsable']=Auth::user()->usr_usuario ;
                    $input['secuencial']=$sec; ////SECUENCIAL DE LA ORDEN
                    $input['documento']=null; 
                    GeneraOrdenes::create($input);
            }
           
            return Redirect(route('genera_ordenes.index'));
    

        }else{

             dd("Ya existe una orden generada con estos datos"); 

        }


    }
    
    public function ordenes_generadas_por_secuencial($sec){
        $sql = "SELECT *,
                to_char(to_date(og.mes::text, 'MM'), 'Month') AS nombre_mes
                FROM ordenes_generadas og 
                JOIN matriculas m ON og.mat_id = m.id
                JOIN jornadas j ON m.jor_id = j.id
                JOIN aniolectivo al ON m.anl_id = al.id 
                JOIN estudiantes es ON m.est_id = es.id
                JOIN cursos c ON m.cur_id = c.id
                JOIN especialidades esp ON m.esp_id = esp.id
                WHERE og.secuencial = '$sec'
                ORDER BY es.est_apellidos";
                
   
        return DB::select($sql);            
    }    

    public function eliminarOrden(Request $rq){

        $dt=$rq->all();
        $secuencial=$dt['secuencial'];
        $ordenes=GeneraOrdenes::where('secuencial',$secuencial)->delete();
        return Redirect(route('genera_ordenes.index'));
    }

    public function genera_xls($secuencial){

        $datos=$this->ordenes_generadas_por_secuencial($secuencial);
        return Excel::download(new OrdenesExport($datos), 'ordenes.xlsx');

    }
    public function upload(){
    
        $documentos=DB::select("SELECT 
        nombre_documento,
        fecha_registro,
        responsable,
        secuencial_documento
        FROM ordenes_documento_banco
        group by
        nombre_documento,
        fecha_registro,
        responsable,
        secuencial_documento ");

        return view("generaOrdenes.upload")
        ->with('documentos',$documentos)
        ;

    }

    public function upload_file(Request $rq){
    
        $file=$rq->file('orden_file');
        $n_documento=($file->getClientOriginalName());
        $sec=$this->ultimo_secuencial();
        Excel::import(new OrdenesImport($sec,$n_documento),$file);
        $doc_importado=DB::select("SELECT * FROM ordenes_documento_banco WHERE secuencial_documento=$sec ");
        $this->actualiza_datos($doc_importado);
        return Redirect(route('genera_ordenes.upload'));
    }
    
    public function actualiza_datos($doc_importado){
    
        try {
            // Iniciar la transacción
            DB::beginTransaction();
            foreach($doc_importado as $di){
                $referencia = explode('|', $di->referencia_adicional);
                $codigo_completo = $referencia[0];
                $aux_codigo = explode('-', $codigo_completo);
                $mat_id = $aux_codigo[1];
                $fecha_pago = $di->fechaprocesodate;
                $valor_pagado = $di->valorprocc;
                $estado = 1;
                $documento = $di->numerotransaccion;
                $sql_consulta = "SELECT * FROM ordenes_generadas WHERE mat_id = $mat_id AND codigo = '$codigo_completo'";
                $consulta = DB::selectOne($sql_consulta);
                if (!empty($consulta)) {
                    $sql_update = "UPDATE ordenes_generadas SET 
                        fecha_pago = '$fecha_pago', 
                        valor_pagado = $valor_pagado, 
                        estado = $estado, 
                        documento = '$documento'
                        WHERE mat_id = $mat_id AND codigo = '$codigo_completo'";
                    DB::update($sql_update);
                    $ord_id = $consulta->ord_id;
                    DB::update("UPDATE ordenes_documento_banco SET ord_id = $ord_id WHERE odb_id = $di->odb_id");
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            // Revertir la transacción en caso de error
            DB::rollBack();
            // Manejo del error
            // Puedes registrar el error o mostrar un mensaje
            // error_log($e->getMessage());
            // o bien:
            echo "Ocurrió un error al procesar la transacción: " . $e->getMessage();
        }
        


    }


    public function ultimo_secuencial(){
    
        $secuencial=DB::selectone("SELECT max(secuencial_documento) FROM ordenes_documento_banco ");
        
        if($secuencial->max==null){
           $sec=1;
        }else{
           $sec=$secuencial->max+1;
        }
        return $sec;
    
    }

    public function upload_show($sec){

        $documentos=DB::select("SELECT * FROM ordenes_documento_banco WHERE secuencial_documento=$sec");
        return view('generaOrdenes.upload_show')
        ->with('documentos',$documentos);
    }

    public function delete($sec){

    OrdenesDocumentoBanco::where('secuencial_documento', $sec)->delete();
    $documentos=DB::select("SELECT 
        nombre_documento,
        fecha_registro,
        responsable,
        secuencial_documento
        FROM ordenes_documento_banco
        group by
        nombre_documento,
        fecha_registro,
        responsable,
        secuencial_documento ");

        return view("generaOrdenes.upload")
        ->with('documentos',$documentos)
        ;
}


    public function report(Request $rq){


        $dt=$rq->all();
        $view='generaOrdenes.report';
        $curso_encabezado="";
        if(isset($dt['btn_buscar'])  ){

            $anl_id=$dt['anl_id'];
            $jor_id=$dt['jor_id'];
            $esp_id=$dt['esp_id'];
            $cur_id=$dt['cur_id'];
            $paralelo=$dt['paralelo'];
            $sql_paralelo="and m.mat_paralelo=''$paralelo'' ";
            $sql_especialidad="";
            if($esp_id!=10 && $esp_id!=8 && $esp_id!=7){
                $sql_especialidad="and m.esp_id=".$esp_id;
                $sql_paralelo="and m.mat_paralelot=''$paralelo'' ";
            }  

            $curso_encabezado=$this->curso_encabezado($anl_id,$jor_id,$esp_id,$cur_id,$paralelo);

            $sql="SELECT * FROM crosstab('select e.est_apellidos|| '' '' ||e.est_nombres ,op.mes , op.estado||''&''||op.valor_pagado||''&''|| op.documento 
            from matriculas m 
            join estudiantes e on e.id=m.est_id
            join cursos c on c.id=m.cur_id
            join ordenes_generadas op on m.id=op.mat_id 
            where m.anl_id=$anl_id
            and m.jor_id=$jor_id
            and m.cur_id=$cur_id
            $sql_especialidad
            $sql_paralelo
            
            and m.mat_estado=1
            group by e.est_apellidos,e.est_nombres,m.jor_id,m.cur_id,e.rep_telefono,op.mes ,op.valor_pagado, op.documento, op.estado 
            order by e.est_apellidos
            '::text, '(select 1 as mes)
            union all
            (select 2 as mes)
            union all
            (select 3 as mes)
            union all
            (select 4 as mes)
            union all
            (select 5 as mes)
            union all
            (select 6 as mes)            
            union all
            (select 7 as mes)            
            union all
            (select 8 as mes)            
            union all
            (select 9 as mes)            
            union all
            (select 10 as mes)            
            union all
            (select 11 as mes)            
            union all
            (select 12 as mes)            
            '::text) crosstab(est text,e text, f text, m text, a text, my text, j text, jl text, ag text, s text, o text, n text, d text);            
            ";
            $datos=DB::select($sql);

            if($dt['btn_buscar']=='btn_imprimir'  ){
                $view='generaOrdenes.print';
            }

            if($dt['btn_buscar']=='btn_exportar'  ){
                // dd('Exportar');
                return Excel::download(new PensionesExport($datos,$curso_encabezado), 'Reporte.xlsx');
                // $view='generaOrdenes.export';
            }

        }else{
            $datos=[];
        }

        $periodos = DB::table('aniolectivo')
                    ->where('anl_selected', 1)
                    ->orderBy('anl_descripcion')
                    ->pluck('anl_descripcion', 'id');

        $jornadas = DB::table('jornadas')
                    ->whereIn('id', [1, 3])
                    ->orderBy('jor_descripcion')
                    ->pluck('jor_descripcion', 'id');

        $especialidades = DB::table('especialidades')
                    ->orderBy('esp_descripcion')
                    ->pluck('esp_descripcion', 'id');

        $cursos = DB::table('cursos')
                    ->orderBy('id')
                    ->pluck('cur_descripcion', 'id');

        return view($view)
        ->with('periodos',$periodos)
        ->with('jornadas',$jornadas)
        ->with('especialidades',$especialidades)
        ->with('cursos',$cursos)
        ->with('datos',$datos)
        ->with('dt',$dt)
        ->with('curso_encabezado',$curso_encabezado)
        ;

    }


    public function curso_encabezado($anl_id,$jor_id,$esp_id,$cur_id,$paralelo){

        $periodo=DB::selectone("SELECT * FROM aniolectivo where id=$anl_id ");
        $jornada=DB::selectone("SELECT * FROM jornadas where id=$jor_id ");
        $especialidad=DB::selectone("SELECT * FROM especialidades where id=$esp_id ");
        $curso=DB::selectone("SELECT * FROM cursos where id=$cur_id ");
        $rst=$periodo->anl_descripcion.'/'.$jornada->jor_descripcion.'/'.$especialidad->esp_descripcion.'/'.$curso->cur_descripcion.'/'.$paralelo;

        return $rst;

    }
    public function buscar_estudiante_orden(Request $rq) {
        
        // Realiza la consulta utilizando el valor de $dato
        $dato=($rq->all());
        $sec=$dato['secuencial'];
        $buscar=$dato['buscar'];
$estudiantes = DB::select("SELECT * 
                                FROM ordenes_generadas o
                                JOIN matriculas m ON m.id = o.mat_id
                                JOIN estudiantes e ON e.id = m.est_id
                                JOIN especialidades esp ON esp.id = m.esp_id
                                JOIN cursos cur ON cur.id = m.cur_id
                                JOIN jornadas jor ON jor.id=m.jor_id
                                WHERE (UPPER(e.est_nombres) LIKE UPPER('%$buscar%') OR
                                     UPPER(e.est_apellidos) LIKE UPPER('%$buscar%') OR
                                     UPPER(e.est_cedula) LIKE UPPER('%$buscar%')) 
                                     AND secuencial=$sec
                                order by e.est_apellidos");
        // Pasa los resultados de la consulta y $dato a la vista
        return view('generaOrdenes.buscar')
            ->with('estudiantes', $estudiantes)
            ->with('sec', $sec)
            ;
    }

    
    



}

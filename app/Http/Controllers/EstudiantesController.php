<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class EstudiantesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $estudiantes=DB::select("SELECT *,m.id as mat_id FROM estudiantes e
                                JOIN matriculas m ON e.id=m.est_id 
                                JOIN cursos c ON m.cur_id=c.id
                                JOIN especialidades esp ON m.esp_id=esp.id
                                limit 10");
        return view('estudiantes.index')
        ->with('estudiantes',$estudiantes); 

    /**
     * Show the form for creating a new resource.
     */
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function buscar(Request $rq) {
        
        // Realiza la consulta utilizando el valor de $dato
        $dato=($rq->buscar);
        $estudiantes = DB::select("SELECT *,m.id as mat_id FROM estudiantes e
                                JOIN matriculas m ON e.id=m.est_id 
                                JOIN cursos c ON m.cur_id=c.id
                                JOIN aniolectivo a ON m.anl_id=a.id
                                JOIN especialidades esp ON m.esp_id=esp.id
                                WHERE (UPPER(e.est_nombres) LIKE UPPER('%$dato%') OR
                                       UPPER(e.est_apellidos) LIKE UPPER('%$dato%') OR
                                       UPPER(e.est_cedula) LIKE UPPER('%$dato%')
                                       ) 
                                       AND a.anl_descripcion='2023-2024'
                                order by e.est_apellidos");
    //     // Pasa los resultados de la consulta y $dato a la vista
        return view('estudiantes.buscar')
            ->with('estudiantes', $estudiantes)
            ;
    }
}

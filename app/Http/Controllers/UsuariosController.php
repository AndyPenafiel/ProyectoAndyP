<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth; // Agregado para importar la clase Auth
use DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios=User::where('usr_id','<>',3)->orderBy('usr_usuario')->get();
        return view('usuarios.index')
        ->with('usuarios', $usuarios); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('usuarios.create'); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $rq)
    {
        $input=$rq->all();
        User::create($input);
        return redirect()->route('usuarios.index');
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
        $usuario = User::find($id);
        return view('usuarios.edit')
        ->with('usuario',$usuario)
        ; 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $rq, string $id)
    {
        $input = $rq->all();
        $usuario = User::find($id);
        $usuario->update($input);
    
        return redirect()->route('usuarios.index');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    User::where('usr_id', $id)->delete();

    return redirect()->route('usuarios.index');
    }

    public function buscar(Request $rq) {
        $dato=($rq->buscar);
        $usuario=DB::select("SELECT * FROM users u 
                                WHERE (UPPER(u.name) LIKE UPPER('%$dato%') OR UPPER(u.usu_apellidos) LIKE UPPER('%$dato%'))
                                order by u.usu_apellidos");
        return view('usuarios.buscar')
        ->with('usuario',$usuario);
        
    }
    
    public function cambio(string $id){
        $usuario = User::find($id);
        return view('usuarios.contrasena')
        ->with('usuario',$usuario); 
    }
    
    public function contrasena(Request $rq, string $id)
    {
        $input = $rq->all();
        $usuario = User::find($id);
        $usuario->update($input);
        
        return redirect()->route('usuarios.index')
        ->with('success', 'Contraseña cambiada con éxito.');

    }

    public function reiniciar(string $usu_no_documento,$id)
    {
        $input['password']=$usu_no_documento;
        $usuario = User::find($id);
        $usuario->update($input);
        
        return redirect()->route('usuarios.index')->with('success', 'Contraseña reiniciada con éxito.');
     }
    
     public function actualizar(string $id)
    {
        dd($id." Falta acabar");
        $usuario = User::find($id);
        return view('usuarios.contrasenauser')
        ->with('usuario',$usuario); 
    }

    public function cambiar_password(Request $rq, string $id){
    }


}


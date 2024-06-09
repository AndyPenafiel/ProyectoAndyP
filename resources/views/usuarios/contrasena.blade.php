@extends('layouts.app')

@section('content')
    <h2 class="div">Cambio de clave del Usuario: <span class="text-success">{{ $usuario->usr_usuario }} {{ $usuario->usu_apellidos }}</span></h2>
    <form method="POST" action="{{ route('contrasena', $usuario->usr_id) }}">
        @csrf
        <div class="form-group">
            <label for="password">Nueva Contraseña:</label>
            <input type="password" id="password" name="password" class="form-control" value="" required>
        </div>
        <button type="submit" class="btn btn-primary btn-lg me-1">Guardar</button>
        {{-- <a href="{{ route('reiniciar', ['cedula' => $usuario->usu_no_documento, 'id' => $usuario->id]) }}" class="btn btn-success btn-lg me-2">Reiniciar CLAVE</a> --}}
        <a href="{{ route('usuarios.index') }}" class="btn btn-danger btn-lg me-2">Cancelar</a>
    </form>
@endsection

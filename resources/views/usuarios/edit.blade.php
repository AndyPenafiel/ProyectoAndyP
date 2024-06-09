@extends('layouts.app')

@section('content')

<br>
<div class="container">
    <h2 class="div text-center">Edición del Usuario: <span class="text-success">{{ $usuario->usr_usuario }} {{ $usuario->usu_apellidos }}</span></h2>
    
        <form method="POST" action="{{ route('usuarios.update', $usuario->usr_id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="usr_usuario" name="usr_usuario" class="form-control" value="{{ $usuario->usr_usuario }}">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ $usuario->email }}">
            </div>
            <button type="submit" class="btn btn-primary btn-lg me-1">Guardar cambios</button>
            <a href="{{ route('usuarios.index') }}" class="btn btn-warning btn-lg me-2">Regresar</a>
        </form>
    </div>
@endsection

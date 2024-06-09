@extends('layouts.app')

@section('content')

<h2 class="div">Crear Usuario:</h2>
<form method="POST" action="{{ route('usuarios.store') }}">
    @csrf
    <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" id="usr_usuario" name="usr_usuario" class="form-control" placeholder="Ingrese su nombre">
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" class="form-control" placeholder="Ingrese su correo electrónico">
    </div>
    <div class="form-group">
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Ingrese su contraseña">
    </div>
    <button type="submit" class="btn btn-primary btn-lg me-1">Guardar Usuario</button>
    <a href="{{ route('usuarios.index') }}" class="btn btn-warning btn-lg me-2">Regresar</a>
</form>
@endsection

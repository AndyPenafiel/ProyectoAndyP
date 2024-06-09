@php
    $contador = 1;
@endphp

@extends('layouts.app')

@section('content')
    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: '¡Contraseña Cambiada!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            });
        </script>
    @endif

    <div class="panel-heading text-center" style="background:#d9edf7 ;">Administracion de Usuarios
        
    </div>
    
    
    <br>
    <a href="{{ route('usuarios.create') }}" class="btn btn-primary me-1 btn-sm d-flex align-items-center justify-content-center text-center">Crear Usuario</a>
    <br>
    <br>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $u)
                <tr>
                    <td>{{ $contador }}</td>
                    <td>{{ $u->usr_usuario }}</td>
                    <td>{{ $u->email }}</td>
                    <td>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <a href="{{ route('usuarios.edit',$u->usr_id) }}" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-pencil"></i></a>
                                    </span>
                                    <span class="input-group-btn">
                                        <a href="{{ route('cambio', $u->usr_id) }}" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-lock"></i></a>
                                        </span>
                                            <form action="{{ route('usuarios.destroy',$u->usr_id) }}" method="POST">
                                                {{ csrf_field() }}
                                                <input name='_method' type='hidden' value='DELETE'>
                                                <button class="btn btn-danger btn-xs" onclick="return confirm('Desea Eliminar')" type="submit"><i class="glyphicon glyphicon-trash"></i></button>
                                            </form>
                                </div><!-- /input-group -->
                        </div><!-- /.row -->
                    </td>
                    
                    
                    
                </tr>
                @php
                    $contador++;
                @endphp
            @endforeach
        </tbody>
    </table>
@endsection

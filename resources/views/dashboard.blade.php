@extends('layouts.app')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Administracion de pensiones</div>

    <div class="panel-body">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <div class="alert alert-success">Ingreso Correcto</div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <form method="POST" action="{{ route('cambiar_password',$usuario->usr_id) }}">
        @csrf

        <div class="form-group row">
            <label for="current_password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña Actual') }}</label>

            <div class="col-md-6">
                <input id="current_password" type="password" class="form-control" name="current_password" required autocomplete="current-password">
            </div>
        </div>

        <div class="form-group row">
            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Nueva Contraseña') }}</label>

            <div class="col-md-6">
                <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
            </div>
        </div>

        <div class="form-group row">
            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar Contraseña') }}</label>

            <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>
        </div>
        <br>
        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Cambiar Contraseña') }}
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

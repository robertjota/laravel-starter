@extends('adminlte::page')

@section('title', 'Crear Usuario')

@section('content_header')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <h2>Editar Usuario</h2>
        </div>
    </div>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.users.update', $user) }}" autocomplete="new-password">
                @csrf
                @method('PUT')

                @include('admin.users.partials.form')

                <button class="btn btn-success float-right" type="submit">Actualizar usuario</button>
                <a class="btn btn-secondary float-right mr-2" href="{{ route('admin.users.index') }}">{{ __('Cancel') }}</a>
            </form>
        </div>
    </div>
@stop

@section('css')
    {{--
<link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });
        });
    </script>
@stop

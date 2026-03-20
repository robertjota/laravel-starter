@extends('adminlte::page')

@section('title', 'Logs de Acceso')

@section('content_header')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <h2>Logs de Acceso</h2>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Evento</th>
                        <th>Dispositivo</th>
                        <th>Plataforma</th>
                        <th>Navegador</th>
                        <th>IP</th>
                        <th>Login</th>
                        <th>Logout</th>
                        <th>Duracion</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($accessLogs as $log)
                        <tr>
                            <td>{{ $log->id }}</td>
                            <td>{{ $log->user?->name }}</td>
                            <td>
                                @if($log->event === 'login')
                                    <span class="badge badge-success">Login</span>
                                @else
                                    <span class="badge badge-secondary">Logout</span>
                                @endif
                            </td>
                            <td>{{ $log->device }}</td>
                            <td>{{ $log->platform }}</td>
                            <td>{{ $log->browser }}</td>
                            <td>{{ $log->ip_address }}</td>
                            <td>{{ $log->login_at?->format('d/m/Y H:i:s') }}</td>
                            <td>{{ $log->logout_at?->format('d/m/Y H:i:s') }}</td>
                            <td>
                                @if($log->login_at && $log->logout_at)
                                    {{ $log->login_at->diffForHumans($log->logout_at, true) }}
                                @else
                                    <span class="badge badge-warning">Activo</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center">No hay registros</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $accessLogs->links() }}
        </div>
    </div>
@stop

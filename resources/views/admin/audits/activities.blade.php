@extends('adminlte::page')

@section('title', 'Auditoria de Actividades')

@section('content_header')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <h2>Auditoria de Actividades</h2>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form method="GET" action="{{ route('admin.audits.activities') }}" class="form-inline">
                <input type="text" name="search" class="form-control mr-2" placeholder="Buscar..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </form>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Descripcion</th>
                        <th>Modelo</th>
                        <th>Evento</th>
                        <th>IP</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($activities as $activity)
                        <tr>
                            <td>{{ $activity->id }}</td>
                            <td>{{ $activity->user?->name ?? 'Sistema' }}</td>
                            <td>{{ $activity->description }}</td>
                            <td>
                                @if($activity->subject_type)
                                    <span class="badge badge-info">{{ class_basename($activity->subject_type) }}</span>
                                @endif
                            </td>
                            <td>
                                @switch($activity->event)
                                    @case('created')
                                        <span class="badge badge-success">Creado</span>
                                        @break
                                    @case('updated')
                                        <span class="badge badge-warning">Actualizado</span>
                                        @break
                                    @case('deleted')
                                        <span class="badge badge-danger">Eliminado</span>
                                        @break
                                    @case('login')
                                        <span class="badge badge-primary">Login</span>
                                        @break
                                    @case('logout')
                                        <span class="badge badge-secondary">Logout</span>
                                        @break
                                    @default
                                        <span class="badge badge-dark">{{ $activity->event }}</span>
                                @endswitch
                            </td>
                            <td>{{ $activity->ip_address }}</td>
                            <td>{{ $activity->created_at->format('d/m/Y H:i:s') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No hay registros</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $activities->withQueryString()->links() }}
        </div>
    </div>
@stop

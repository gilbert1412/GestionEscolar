@extends('index')


@section('contenido')
    <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between pb-3 mb-4 border-bottom">
        <div>
            <h1 class="h3 font-weight-bold mb-1" style="color: #0f172a; letter-spacing: -0.5px;">Gestión de Asignaturas</h1>
            <p class="text-muted small mb-0">Administra las asignaturas de la institución.</p>
        </div>
        <button type="button" class="btn btn-primary btn-sm px-3 py-2 mt-3 mt-sm-0 shadow-sm rounded-lg"
            style="background-color: #2563eb; border-color: #2563eb; font-weight: 500;" data-toggle="modal"
            data-target="#modalUsuario" onclick="modoCrear()">
            <i class="fas fa-plus fa-xs mr-2"></i> Nueva Asignatura
        </button>
    </div>

    <!-- Aca van las incrustaciones de livewire -->
    <livewire:curso.create />

@endsection
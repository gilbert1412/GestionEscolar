@extends('index')


@section('contenido')
    <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between pb-3 mb-4 border-bottom">
        <div>
            <h1 class="h3 font-weight-bold mb-1" style="color: #0f172a; letter-spacing: -0.5px;">Gestión de Matriculas</h1>
            <p class="text-muted small mb-0">Administra las Matriculas de la institución.</p>
        </div>
        <button type="button" class="btn btn-primary btn-sm shadow-sm" data-toggle="modal" data-target="#modalMatricula" onclick="modoCrear()">
            <i class="fas fa-clipboard-list fa-sm text-white-50 mr-1"></i> Nueva Matrícula
        </button>
    </div>

    <!-- Aca van las incrustaciones de livewire -->
    <livewire:matricula.create />

@endsection
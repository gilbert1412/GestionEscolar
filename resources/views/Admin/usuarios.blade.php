@extends('index')


@section('contenido')
  <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between pb-3 mb-4 border-bottom">
    <div>
        <h1 class="h3 font-weight-bold mb-1" style="color: #0f172a; letter-spacing: -0.5px;">Gestión de Usuarios</h1>
        <p class="text-muted small mb-0">Administra los accesos y roles de la comunidad escolar.</p>
    </div>
    <button type="button" class="btn btn-primary btn-sm px-3 py-2 mt-3 mt-sm-0 shadow-sm rounded-lg" 
            style="background-color: #2563eb; border-color: #2563eb; font-weight: 500;" 
            data-toggle="modal" data-target="#modalUsuario" onclick="modoCrear()">
        <i class="fas fa-plus fa-xs mr-2"></i> Nuevo Usuario
    </button>
</div>

<!-- Alertas adaptadas -->
<div class="alert alert-success border-0 shadow-sm rounded-lg d-none" id="alertaExito" role="alert" style="background-color: #ecfdf5; color: #065f46;">
    <div class="d-flex align-items-center">
        <i class="fas fa-check-circle mr-2 fa-lg"></i>
        <span>Usuario guardado correctamente.</span>
        <button type="button" class="close ml-auto" data-dismiss="alert" style="color: #065f46; outline: none;">&times;</button>
    </div>
</div>

<!-- Tabla de datos principal -->
<livewire:usuario.tabla />

<!-- Modal de Formulario -->
<livewire:usuario.create />
@endsection

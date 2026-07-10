<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<div class="modal fade" id="modalUsuario" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg">
            <form id="formUsuario">
                <div class="modal-header border-0 pb-0" style="background-color: #ffffff;">
                    <h5 class="modal-title font-weight-bold" id="tituloModalUsuario" style="color: #0f172a;">
                        <i class="fas fa-user-plus text-primary mr-2" style="color: #2563eb !important;"></i>Nuevo Usuario
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="outline: none;">
                        <span aria-hidden="true" style="font-size: 1.5rem;">&times;</span>
                    </button>
                </div>

                <div class="modal-body py-4">
                    <input type="hidden" id="usuario_id">

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nombre" class="small font-weight-bold text-muted text-uppercase" style="letter-spacing: 0.5px;">Nombre</label>
                            <input type="text" class="form-control rounded-lg shadow-sm" id="nombre" placeholder="Ej. María" required style="border-color: #cbd5e1; height: 42px;">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="apellido" class="small font-weight-bold text-muted text-uppercase" style="letter-spacing: 0.5px;">Apellido</label>
                            <input type="text" class="form-control rounded-lg shadow-sm" id="apellido" placeholder="Ej. Gómez" required style="border-color: #cbd5e1; height: 42px;">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label for="email" class="small font-weight-bold text-muted text-uppercase" style="letter-spacing: 0.5px;">Correo electrónico</label>
                            <div class="input-group shadow-sm rounded-lg overflow-hidden">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light border-right-0" style="border-color: #cbd5e1;"><i class="fas fa-envelope text-muted"></i></span>
                                </div>
                                <input type="email" class="form-control border-left-0" id="email" placeholder="usuario@escuela.com" required style="border-color: #cbd5e1; height: 42px;">
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="rol" class="small font-weight-bold text-muted text-uppercase" style="letter-spacing: 0.5px;">Rol</label>
                            <select class="form-control rounded-lg shadow-sm" id="rol" required style="border-color: #cbd5e1; height: 42px;">
                                <option value="">Seleccionar...</option>
                                <option value="admin">Administrador</option>
                                <option value="docente">Docente</option>
                                <option value="alumno">Alumno</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row" id="filaPassword">
                        <div class="form-group col-md-6">
                            <label for="password" class="small font-weight-bold text-muted text-uppercase" style="letter-spacing: 0.5px;">Contraseña</label>
                            <input type="password" class="form-control rounded-lg shadow-sm" id="password" placeholder="Mínimo 8 caracteres" style="border-color: #cbd5e1; height: 42px;">
                            <small class="form-text text-muted mt-2">Déjalo vacío al editar si no deseas cambiarla.</small>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password_confirm" class="small font-weight-bold text-muted text-uppercase" style="letter-spacing: 0.5px;">Confirmar contraseña</label>
                            <input type="password" class="form-control rounded-lg shadow-sm" id="password_confirm" placeholder="Repite la contraseña" style="border-color: #cbd5e1; height: 42px;">
                        </div>
                    </div>

                    <div class="form-group form-check mt-3 pl-0">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="estado" checked>
                            <label class="custom-control-label font-weight-500" for="estado" style="color: #334155; cursor: pointer; padding-top: 2px;">Usuario activo</label>
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-0 bg-light d-flex justify-content-end" style="border-bottom-left-radius: .3rem; border-bottom-right-radius: .3rem;">
                    <button type="button" class="btn btn-link text-muted font-weight-500" data-dismiss="modal" style="text-decoration: none;">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary px-4 rounded-lg shadow-sm" style="background-color: #2563eb; border-color: #2563eb; font-weight: 500; height: 40px;">
                        Guardar Usuario
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
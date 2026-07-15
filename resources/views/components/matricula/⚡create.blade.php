<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<div>
    <!-- Card: tabla de matrículas -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-wrap align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-clipboard-list mr-1"></i> Matrículas registradas
            </h6>
            <div class="d-flex align-items-center">
                <select class="form-control form-control-sm mr-2" id="filtroPeriodo" style="width: auto;">
                    <option value="">Todos los periodos</option>
                    <option value="2026-I">2026-I</option>
                    <option value="2025-II">2025-II</option>
                </select>
                <div class="input-group input-group-sm" style="width: 220px;">
                    <input type="text" id="buscarMatricula" class="form-control" placeholder="Buscar alumno o curso...">
                    <div class="input-group-append">
                        <span class="input-group-text bg-primary text-white"><i class="fas fa-search"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle" id="tablaMatriculas" width="100%">
                    <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Alumno</th>
                            <th>Curso</th>
                            <th>Periodo académico</th>
                            <th>Fecha de matrícula</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Fila de ejemplo #1 -->
                        <tr data-id="1" data-user-id="4" data-alumno="Luis Fernández" data-curso-id="2" data-curso="Matemática III" data-periodo="2026-I">
                            <td>#1</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="icon-circle bg-primary text-white mr-2">LF</div>
                                    Luis Fernández
                                </div>
                            </td>
                            <td>Matemática III</td>
                            <td><span class="badge badge-primary">2026-I</span></td>
                            <td>10/01/2026</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-primary" title="Editar" data-toggle="modal" data-target="#modalMatricula" onclick="modoEditar(this)">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger" title="Eliminar" data-toggle="modal" data-target="#modalEliminar" onclick="confirmarEliminar(1, 'Luis Fernández', 'Matemática III')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        <!-- Fila de ejemplo #2 -->
                        <tr data-id="2" data-user-id="5" data-alumno="Ana Torres" data-curso-id="1" data-curso="Comunicación II" data-periodo="2026-I">
                            <td>#2</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="icon-circle bg-success text-white mr-2">AT</div>
                                    Ana Torres
                                </div>
                            </td>
                            <td>Comunicación II</td>
                            <td><span class="badge badge-primary">2026-I</span></td>
                            <td>12/01/2026</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-primary" title="Editar" data-toggle="modal" data-target="#modalMatricula" onclick="modoEditar(this)">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger" title="Eliminar" data-toggle="modal" data-target="#modalEliminar" onclick="confirmarEliminar(2, 'Ana Torres', 'Comunicación II')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        <!-- Fila de ejemplo #3 -->
                        <tr data-id="3" data-user-id="6" data-alumno="Pedro Ríos" data-curso-id="2" data-curso="Matemática III" data-periodo="2025-II">
                            <td>#3</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="icon-circle bg-warning text-white mr-2">PR</div>
                                    Pedro Ríos
                                </div>
                            </td>
                            <td>Matemática III</td>
                            <td><span class="badge badge-secondary">2025-II</span></td>
                            <td>05/08/2025</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-primary" title="Editar" data-toggle="modal" data-target="#modalMatricula" onclick="modoEditar(this)">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger" title="Eliminar" data-toggle="modal" data-target="#modalEliminar" onclick="confirmarEliminar(3, 'Pedro Ríos', 'Matemática III')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
 
                <!-- Mensaje de tabla vacía (oculto por defecto) -->
                <div class="text-center text-muted py-4 d-none" id="tablaVacia">
                    <i class="fas fa-folder-open fa-2x mb-2 d-block"></i>
                    No hay matrículas registradas todavía.
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modalMatricula" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="formMatricula">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="tituloModalMatricula">
                        <i class="fas fa-clipboard-list mr-2"></i>Nueva Matrícula
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
 
                <div class="modal-body">
                    <input type="hidden" id="matricula_id">
 
                    <div class="form-group">
                        <label for="alumno_id">Alumno</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user-graduate"></i></span>
                            </div>
                            <select class="form-control" id="alumno_id" required>
                                <option value="">Seleccionar alumno...</option>
                                <option value="4">Luis Fernández</option>
                                <option value="5">Ana Torres</option>
                                <option value="6">Pedro Ríos</option>
                                <option value="7">Sofía Mendoza</option>
                            </select>
                        </div>
                    </div>
 
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label for="curso_id">Curso</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-book"></i></span>
                                </div>
                                <select class="form-control" id="curso_id" required>
                                    <option value="">Seleccionar curso...</option>
                                    <option value="1">Comunicación II</option>
                                    <option value="2">Matemática III</option>
                                    <option value="3">Ciencias Naturales</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="periodo_academico">Periodo académico</label>
                            <select class="form-control" id="periodo_academico" required>
                                <option value="">Seleccionar...</option>
                                <option value="2026-I">2026-I</option>
                                <option value="2025-II">2025-II</option>
                                <option value="2025-I">2025-I</option>
                            </select>
                        </div>
                    </div>
 
                    <div class="alert alert-light border small mb-0">
                        <i class="fas fa-info-circle text-primary mr-1"></i>
                        Un alumno no puede matricularse dos veces en el mismo curso durante el mismo periodo académico.
                    </div>
                </div>
 
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times mr-1"></i>Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-1"></i>Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

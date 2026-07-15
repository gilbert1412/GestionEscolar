<?php

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\Curso;

new class extends Component {
    use WithPagination;

    public $nombre_curso, $codigo, $user_id;
    public $buscarCurso = '';
    public $editando = false;
    public $curso_id;


};
?>

<div>
    <div class="row">

        {{-- ==================== COLUMNA IZQUIERDA: FORMULARIO (Ancho: 4/12) ==================== --}}
        <div class="col-12 col-lg-4 mb-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 12px; background-color: #ffffff;">
                <div class="card-header bg-transparent py-3 d-flex align-items-center"
                    style="border-bottom: 1px solid #f1f5f9;">
                    <div class="d-flex align-items-center justify-content-center bg-light text-primary rounded mr-3"
                        style="width: 36px; height: 36px; min-width: 36px;">
                        <i class="fas fa-book-open" style="color: #4f46e5;"></i>
                    </div>
                    <div>
                        <h6 class="m-0 font-weight-bold" style="color: #0f172a; font-size: 0.95rem;">
                            {{ $editando ? 'Editar Curso' : 'Nuevo Curso' }}
                        </h6>
                        <p class="text-muted m-0" style="font-size: 0.75rem;">
                            {{ $editando ? 'Modifica los datos del curso' : 'Registra una nueva materia' }}
                        </p>
                    </div>
                </div>

                <div class="card-body d-flex flex-column justify-content-between pt-4">
                    <form wire:submit.prevent="guardar" class="h-100 d-flex flex-column justify-content-between">
                        <div>
                            <!-- Nombre del curso -->
                            <div class="form-group mb-3">
                                <label class="text-muted small font-weight-bold mb-2"
                                    style="letter-spacing: 0.5px; font-size: 0.725rem;">
                                    NOMBRE DEL CURSO <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('nombre_curso') is-invalid @enderror"
                                    style="border-radius: 8px; border-color: #cbd5e1; padding: 0.6rem 0.9rem; font-size: 0.875rem;"
                                    placeholder="Ej. Programación I" wire:model.defer="nombre_curso">
                                @error('nombre_curso')
                                    <span class="invalid-feedback d-block mt-1"
                                        style="font-size: 0.75rem;">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Código -->
                            <div class="form-group mb-3">
                                <label class="text-muted small font-weight-bold mb-2"
                                    style="letter-spacing: 0.5px; font-size: 0.725rem;">
                                    CÓDIGO <span class="text-danger">*</span>
                                </label>
                                <input type="text"
                                    class="form-control text-uppercase @error('codigo') is-invalid @enderror"
                                    style="border-radius: 8px; border-color: #cbd5e1; padding: 0.6rem 0.9rem; font-size: 0.875rem;"
                                    placeholder="Ej. PRG-101" wire:model.defer="codigo">
                                @error('codigo')
                                    <span class="invalid-feedback d-block mt-1"
                                        style="font-size: 0.75rem;">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Docente -->
                            <div class="form-group mb-4">
                                <label class="text-muted small font-weight-bold mb-2"
                                    style="letter-spacing: 0.5px; font-size: 0.725rem;">
                                    DOCENTE ASIGNADO
                                </label>
                                <select class="form-control @error('user_id') is-invalid @enderror"
                                    style="border-radius: 8px; border-color: #cbd5e1; padding: 0.6rem 0.9rem; height: auto; font-size: 0.875rem;"
                                    wire:model.defer="user_id">
                                    <option value="">Seleccione un docente...</option>
                                    <!-- Opciones cargadas dinámicamente -->
                                </select>
                                @error('user_id')
                                    <span class="invalid-feedback d-block mt-1"
                                        style="font-size: 0.75rem;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Botonera -->
                        <div class="d-flex align-items-center pt-3" style="border-top: 1px solid #f1f5f9;">
                            @if($editando)
                                <button type="button"
                                    class="btn btn-link text-muted font-weight-bold text-decoration-none mr-auto px-0"
                                    style="font-size: 0.825rem;" wire:click="cancelarEdicion">
                                    Cancelar
                                </button>
                            @endif

                            <button type="submit" class="btn rounded-lg text-white shadow-sm px-4 py-2 ml-auto"
                                style="background-color: #4f46e5; border: none; font-weight: 500; font-size: 0.825rem; transition: all 0.2s;"
                                wire:loading.attr="disabled" wire:target="guardar">

                                <span wire:loading.remove wire:target="guardar">
                                    <i class="fas {{ $editando ? 'fa-sync-alt' : 'fa-plus' }} mr-1"></i>
                                    {{ $editando ? 'Actualizar' : 'Guardar' }}
                                </span>

                                <span wire:loading wire:target="guardar">
                                    <i class="fas fa-circle-notch fa-spin mr-1"></i> Procesando...
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- ==================== COLUMNA DERECHA: TABLA (Ancho: 8/12) ==================== --}}
        <div class="col-12 col-lg-8 mb-4">
            <div class="card border-0 shadow-sm h-100"
                style="border-radius: 12px; overflow: hidden; background-color: #ffffff;">
                <div class="card-header bg-transparent py-3 d-flex flex-column flex-sm-row align-items-sm-center justify-content-between border-bottom-0"
                    style="gap: 12px;">
                    <div class="d-flex align-items-center">
                        <div class="d-flex align-items-center justify-content-center bg-light text-primary rounded mr-3"
                            style="width: 36px; height: 36px; min-width: 36px;">
                            <i class="fas fa-graduation-cap" style="color: #4f46e5;"></i>
                        </div>
                        <div>
                            <h6 class="m-0 font-weight-bold" style="color: #0f172a; font-size: 0.95rem;">Cursos
                                Registrados</h6>
                            <p class="text-muted m-0" style="font-size: 0.75rem;">Listado general de materias activas
                            </p>
                        </div>
                    </div>

                    <!-- Buscador -->
                    <div class="input-group shadow-sm" style="max-width: 260px; border-radius: 8px; overflow: hidden;">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white border-right-0 text-muted pr-2 pl-3"
                                style="border-color: #e2e8f0;">
                                <i class="fas fa-search" style="font-size: 0.8rem;"></i>
                            </span>
                        </div>
                        <input type="text" id="buscarCurso" class="form-control border-left-0 pl-1"
                            placeholder="Buscar materia..."
                            style="border-color: #e2e8f0; font-size: 0.825rem; height: calc(1.5em + 0.75rem + 2px);"
                            wire:model.live.debounce.400ms="buscarCurso">
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" id="tablaCursos">
                            <thead
                                style="background-color: #f8fafc; color: #64748b; font-size: 0.725rem; text-transform: uppercase; letter-spacing: 0.8px;">
                                <tr>
                                    <th class="border-0 pl-4 py-3" style="width: 20%;">Código</th>
                                    <th class="border-0 py-3" style="width: 45%;">Curso</th>
                                    <th class="border-0 py-3" style="width: 20%;">Docente</th>
                                    <th class="border-0 text-right pr-4 py-3" style="width: 15%;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody style="color: #334155; font-size: 0.875rem;">

                                <!-- ESTADO VACÍO (Reemplázalo dinámicamente con tus filas de Laravel) -->
                                <tr>
                                    <td colspan="4" class="text-center py-5" style="background-color: #ffffff;">
                                        <div class="py-5">
                                            <div class="d-inline-flex align-items-center justify-content-center bg-light rounded-circle mb-3"
                                                style="width: 64px; height: 64px;">
                                                <i class="fas fa-folder-open fa-lg" style="color: #cbd5e1;"></i>
                                            </div>
                                            <h6 class="font-weight-bold mb-1"
                                                style="color: #475569; font-size: 0.9rem;">
                                                {{ $buscarCurso ? 'No se encontraron resultados' : 'No hay materias registradas' }}
                                            </h6>
                                            <p class="text-muted small mb-0 px-3" style="font-size: 0.775rem;">
                                                {{ $buscarCurso ? 'Intenta con otro término.' : 'Comienza agregando un curso en el panel de la izquierda.' }}
                                            </p>
                                        </div>
                                    </td>

                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
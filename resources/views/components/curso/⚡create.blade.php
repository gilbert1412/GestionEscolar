<?php

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\Curso;
use App\Models\Cursos;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Spatie\Permission\Models\Role;

new class extends Component {
    use WithPagination;

    public $nombre_curso, $codigo, $user_id;
    public $buscarCurso = '';
    public $editando = false;
    public $curso_id;

    #[Computed]
    public function docentesDisponibles()
    {
        return Role::where('name', 'docente')->first()->users()->select('id', 'nombre', 'apellido')->get();
    }
    #[Computed]
    public function listarCursos()
    {
        return Cursos::with('docente')
            ->where(function ($query) {
                $query->where('nombre_curso', 'like', "%{$this->buscarCurso}%")
                    ->orWhere('codigo', 'like', "%{$this->buscarCurso}%")
                    ->orWhereHas('docente', function ($q) {
                        $q->where('nombre', 'like', "%{$this->buscarCurso}%")
                            ->orWhere('apellido', 'like', "%{$this->buscarCurso}%");
                    });
            })
            ->get();
    }

    public function guardarCursos()
    {
        $this->validate([
            'nombre_curso' => 'required|string|max:255',
            'codigo' => 'required|string|max:50|unique:cursos,codigo,' . ($this->curso_id ?? 'NULL') . ',id',
            'user_id' => 'nullable|exists:users,id',
        ]);

        if ($this->editando) {
            $curso = Cursos::find($this->curso_id);
            $curso->update([
                'nombre_curso' => $this->nombre_curso,
                'codigo' => $this->codigo,
                'user_id' => $this->user_id,
            ]);
            
            $this->dispatch('cerrar-modal', message: 'Curso actualizado exitosamente.');
            
        } else {
            Cursos::create([
                'nombre_curso' => $this->nombre_curso,
                'codigo' => $this->codigo,
                'user_id' => $this->user_id,
            ]);
            
            $this->dispatch('cerrar-modal', message: 'Curso registrado exitosamente.');
        }

        $this->resetearFormulario();
    }

    public function cancelar()
    {
        $this->resetearFormulario();
    }

    public function editarCurso($id)
    {
        $curso = Cursos::findOrFail($id);
        $this->curso_id = $curso->id;
        $this->nombre_curso = $curso->nombre_curso;
        $this->codigo = $curso->codigo;
        $this->user_id = $curso->user_id;
        $this->editando = true;
    }
    public function resetearFormulario()
    {
        $this->resetValidation(); // Elimina los errores
        $this->reset(); // Limpia los campos del formulario
        $this->editando = false;
    }
    #[On('eliminar-curso')]
    public function eliminarCurso($id)
    {
        $curso = Cursos::findOrFail($id);
        $curso->delete();
        $this->dispatch('cerrar-modal', message: 'Curso eliminado exitosamente.');
    }
    
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
                    <form wire:submit.prevent="guardarCursos" class="h-100 d-flex flex-column justify-content-between">
                        <div>
                            <!-- Nombre del curso -->
                            <div class="form-group mb-3">
                                <label class="text-muted small font-weight-bold mb-2"
                                    style="letter-spacing: 0.5px; font-size: 0.725rem;">
                                    NOMBRE DEL CURSO <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control"
                                    style="border-radius: 8px; border-color: #cbd5e1; padding: 0.6rem 0.9rem; font-size: 0.875rem;"
                                    placeholder="Ej. Programación I" wire:model="nombre_curso">
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
                                    class="form-control text-uppercase"
                                    style="border-radius: 8px; border-color: #cbd5e1; padding: 0.6rem 0.9rem; font-size: 0.875rem;"
                                    placeholder="Ej. PRG-101" wire:model="codigo">
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
                                <select class="form-control"
                                    style="border-radius: 8px; border-color: #cbd5e1; padding: 0.6rem 0.9rem; height: auto; font-size: 0.875rem;"
                                    wire:model="user_id">
                                    <option value="">Seleccione un docente...</option>
                                    <!-- Opciones cargadas dinámicamente -->
                                    @foreach ($this->docentesDisponibles as $docente)
                                    <option value="{{ $docente->id }}">{{ $docente->nombre }} {{ $docente->apellido }}</option>
                                    @endforeach
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
                                style="font-size: 0.825rem;" wire:click="cancelar">
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
                                    <th class="border-0 pl-4 py-3" style="width: 5%;">Id</th>
                                    <th class="border-0 pl-4 py-3" style="width: 10%;">Código</th>
                                    <th class="border-0 py-3" style="width: 20%;">Curso</th>
                                    <th class="border-0 py-3" style="width: 20%;">Docente</th>
                                    <th class="border-0 text-right pr-4 py-3" style="width: 15%;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody style="color: #334155; font-size: 0.875rem;">

                                @forelse ($this->listarCursos as $curso)
                                <tr wire:key="curso-{{ $curso->id }}"> 
                                    <td class=" py-3">{{ $loop->iteration }}</td> 
                                    <td class="pl-4 py-3">{{ $curso->codigo }}</td>
                                    <td class="py-3">{{ $curso->nombre_curso }}</td>
                                    <td class="py-3">
                                        {{ $curso->docente ? $curso->docente->nombre . ' ' . $curso->docente->apellido : 'Sin docente' }}
                                    </td>
                                    <td class="text-right pr-4 py-3">
                                        <button class="btn btn-sm btn-link text-primary mr-2" wire:click="editarCurso({{ $curso->id }})">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-link text-danger" wire:click="$dispatch('confirmar-eliminacion', { id: {{ $curso->id }} })">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">
                                        <i class="fas fa-folder-open d-block mb-2 fa-2x"></i>
                                        No hay cursos registrados o no coinciden con la búsqueda.
                                    </td>
                                </tr>
                                @endforelse


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@script
    <script>
       
        this.$on('cerrar-modal', (event) => {
        $('#modalUsuario').modal('hide');

        Swal.fire({
            icon: 'success',
            title: 'Correcto',
            text: event.message,
            timer: 3000,
            showConfirmButton: false
        });

        this.$on('confirmar-eliminacion', (event) => {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.$dispatch('eliminar-curso', { id: event.id });
                    Swal.fire(
                        '¡Eliminado!',
                        'El curso ha sido eliminado.',
                        'success'
                    );
                }
            });
        });
    });
    </script>
@endscript
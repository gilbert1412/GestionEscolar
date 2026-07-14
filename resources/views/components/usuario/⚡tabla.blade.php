<?php

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\User;
use Livewire\Attributes\Reactive;
use Livewire\Attributes\On;
new class extends Component {

   
    public $roles=[];
    public $buscarUsuario = '';

    public function mostrarRoles()
    {
        $this->roles = User::with('roles')->get();
    }
    #[On('cerrar-modal')]
    #[Computed]
    public function usuarios()
    {
       return User::with('roles')
        ->select('id', 'nombre', 'apellido', 'email')
        ->where(function ($query) {
            $query->where('nombre', 'like', "%{$this->buscarUsuario}%")
                ->orWhere('apellido', 'like', "%{$this->buscarUsuario}%")
                ->orWhere('email', 'like', "%{$this->buscarUsuario}%")
                ->orWhereHas('roles', function ($q) {
                    $q->where('name', 'like', "%{$this->buscarUsuario}%");
                });
        })
        ->get();
    }

    #[On('abrir-modal')]
    public function abrirModal($id)
    {
        $this->dispatch('mostrar-usuario', id: $id)->to('usuario.create');;
    }
    #[On('eliminar-usuario')]
    public function eliminarUsuario($id)
    {
        
        $usuario = User::findOrFail($id);
        $usuario->delete();
        $this->dispatch('cerrar-modal');
        
    }
};
?>

<div class="card border-0 shadow-sm rounded-lg overflow-hidden mb-4">
    <div
        class="card-header bg-white py-3 d-flex flex-column flex-md-row align-items-md-center justify-content-between border-bottom-0">
        <div class="mb-2 mb-md-0">
            <h6 class="m-0 font-weight-bold" style="color: #1e293b;">
                <i class="fas fa-users text-muted mr-2"></i>Usuarios registrados
            </h6>
        </div>
        <div class="input-group input-group-sm shadow-sm rounded" style="max-width: 320px;">
            <div class="input-group-prepend">
                <span class="input-group-text bg-white border-right-0 text-muted pr-1" style="border-color: #cbd5e1;">
                    <i class="fas fa-search"></i>
                </span>
            </div>
            <input type="text" id="buscarUsuario" class="form-control border-left-0 pl-1"
                placeholder="Buscar por nombre o email..." style="border-color: #cbd5e1;"  wire:model.live="buscarUsuario">
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="tablaUsuarios" style="vertical-align: middle;">
                <thead
                    style="background-color: #f1f5f9; color: #475569; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px;">
                    <tr>
                        <th class="border-0 pl-4 py-3">Usuario</th>
                        <th class="border-0 py-3">Email</th>
                        <th class="border-0 py-3">Rol</th>
                        
                        <th class="border-0 text-right pr-4 py-3">Acciones</th>
                    </tr>
                </thead>
                <tbody style="color: #334155; font-size: 0.95rem;">
                    @foreach ($this->usuarios as $usuario)

                        <tr>
                            <td class="pl-4 py-3">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center text-white font-weight-bold mr-3 shadow-sm"
                                        style="width: 40px; height: 40px; background: #2563eb; font-size: 0.9rem;">

                                        {{ strtoupper(substr($usuario->nombre ?? '', 0, 1) . substr($usuario->apellido ?? '', 0, 1)) }}

                                    </div>
                                    <div>
                                        <div class="font-weight-bold" style="color: #0f172a;">{{$usuario->nombre}}
                                            {{$usuario->apellido}}
                                        </div>
                                        <small class="text-muted">ID {{ $loop->index + 1 }}</small>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3">{{$usuario->email}}</td>
                            <td class="py-3">
                                <span class="badge px-3 py-2 rounded-pill font-weight-600"
                                    style="background-color: #fee2e2; color: #991b1b; font-size: 0.8rem;">
                                    {{ $usuario->roles->first()?->name }}

                                </span>
                            </td>
                            
                            <td class="text-right pr-4 py-3">
                                <div class="btn-group" role="group">
                                    <button class="btn btn-sm btn-light border text-primary mr-1 rounded-lg" title="Editar"
                                        data-toggle="modal" data-target="#modalUsuario" wire:click="$dispatch('abrir-modal', { id: {{ $usuario->id }} })">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-light border text-danger rounded-lg" title="Eliminar"
                                        data-toggle="modal" data-target="#modalEliminar"
                                         wire:click="$dispatch('confirmar-eliminacion', { id: {{ $usuario->id }} })">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach




                </tbody>
            </table>

            <div class="text-center text-muted py-5 d-none" id="tablaVacia" style="background-color: #ffffff;">
                <i class="fas fa-folder-open fa-3x mb-3 text-muted" style="opacity: 0.5;"></i>
                <p class="font-weight-bold mb-1">No hay usuarios registrados todavía</p>
                <small>Haz clic en "Nuevo Usuario" para comenzar.</small>
            </div>
        </div>
    </div>
</div>

@script
    <script>
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
                    this.$dispatch('eliminar-usuario', { id: event.id });
                    Swal.fire(
                        '¡Eliminado!',
                        'El usuario ha sido eliminado.',
                        'success'
                    );
                }
            });
        });
    </script>
@endscript
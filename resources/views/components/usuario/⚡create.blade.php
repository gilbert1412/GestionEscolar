<?php

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;

new class extends Component
{

    public $nombre;
    public $apellido;
    public $email;
    public $rol;
    public $password;
    public $password_confirmation;
    public $usuarioId = null;

    #[Computed]
    public function roles()
    {
        return Role::all();
    }
    #[On('mostrar-usuario')]
    public function mostrarUsuario($id)
    { 
        
        $usuario = User::with('roles')->findOrFail($id);

        $this->usuarioId = $usuario->id;
        $this->nombre = $usuario->nombre;
        $this->apellido = $usuario->apellido;
        $this->email = $usuario->email;
        $this->rol = $usuario->roles->first()?->name;
    }

    public function registrarUsuario()
    {
       $rules = [
        'nombre' => 'required|string|max:255',
        'apellido' => 'required|string|max:255',
        'rol' => 'required|string|exists:roles,name',
    ];

    if ($this->usuarioId) {
        $rules['email'] = 'required|email|unique:users,email,' . $this->usuarioId;

        if ($this->password) {
            $rules['password'] = 'min:8|confirmed';
        }
    } else {
        $rules['email'] = 'required|email|unique:users,email';
        $rules['password'] = 'required|min:8|confirmed';
    }

    $this->validate($rules);

    if ($this->usuarioId) {

        $usuario = User::findOrFail($this->usuarioId);

        $usuario->update([
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
            'email' => $this->email,
        ]);

        if ($this->password) {
            $usuario->update([
                'password' => bcrypt($this->password),
            ]);
        }

        $usuario->syncRoles([$this->rol]);

      
        $this->dispatch('cerrar-modal', message: 'Usuario actualizado exitosamente.');

    } else {

        $usuario = User::create([
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);

        $usuario->assignRole($this->rol);

        
        $this->dispatch('cerrar-modal', message: 'Usuario registrado exitosamente.');
    }

    $this->limpiarFormulario();
    
    }

    public function limpiarFormulario()
    {
        $this->resetValidation(); // Elimina los errores
        $this->reset(); // Limpia los campos del formulario
    }
};
?>
<div>

    <div wire:ignore.self class="modal fade" id="modalUsuario" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content border-0 shadow-lg">
                <form wire:submit.prevent="registrarUsuario">
                    <div class="modal-header border-0 pb-0" style="background-color: #ffffff;">
                        <h5 class="modal-title font-weight-bold" id="tituloModalUsuario" style="color: #0f172a;">
                            <i class="fas fa-user-plus text-primary mr-2" style="color: #2563eb !important;" wire:click="modal"></i>Nuevo Usuario
                        </h5>
                        <button wire:click="limpiarFormulario" type="button" class="close" data-dismiss="modal" aria-label="Close" style="outline: none;">
                            <span aria-hidden="true" style="font-size: 1.5rem;">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body py-4">
                        <input type="hidden" id="usuario_id">

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nombre" class="small font-weight-bold text-muted text-uppercase" style="letter-spacing: 0.5px;">Nombre</label>
                                <input type="text" class="form-control rounded-lg shadow-sm" wire:model="nombre" placeholder="Ej. María" style="border-color: #cbd5e1; height: 42px;">
                                <span class="text-danger *">
                                    @error('nombre') <span class="text-danger">{{ $message }}</span> @enderror
                                </span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="apellido" class="small font-weight-bold text-muted text-uppercase" style="letter-spacing: 0.5px;">Apellido</label>
                                <input type="text" class="form-control rounded-lg shadow-sm" wire:model="apellido" placeholder="Ej. Gómez" style="border-color: #cbd5e1; height: 42px;">
                                <span class="text-danger *">
                                    @error('apellido') <span class="text-danger">{{ $message }}</span> @enderror
                                </span>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label for="email" class="small font-weight-bold text-muted text-uppercase" style="letter-spacing: 0.5px;">Correo electrónico</label>
                                <div class="input-group shadow-sm rounded-lg overflow-hidden">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light border-right-0" style="border-color: #cbd5e1;"><i class="fas fa-envelope text-muted"></i></span>
                                    </div>
                                    <input type="email" class="form-control border-left-0" id="email" placeholder="usuario@escuela.com" wire:model="email" style="border-color: #cbd5e1; height: 42px;">
                                </div>
                                <span class="text-danger">
                                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                </span>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="rol" class="small font-weight-bold text-muted text-uppercase" style="letter-spacing: 0.5px;">Rol</label>
                                <select class="form-control rounded-lg shadow-sm" id="rol" wire:model="rol" style="border-color: #cbd5e1; height: 42px;">
                                    <option value="">Seleccionar...</option>
                                    @foreach ($this->roles as $rol)
                                    <option value="{{ $rol->name }}">{{ ucfirst($rol->name) }}</option>
                                    @endforeach

                                </select>
                                <span class="text-danger ">
                                    @error('rol') <span class="text-danger">{{ $message }}</span> @enderror
                                </span>
                            </div>
                        </div>

                        <div class="form-row" id="filaPassword">
                            <div class="form-group col-md-6">
                                <label for="password" class="small font-weight-bold text-muted text-uppercase" style="letter-spacing: 0.5px;">Contraseña</label>
                                <input type="password" class="form-control rounded-lg shadow-sm" id="password" placeholder="Mínimo 8 caracteres" wire:model="password" style="border-color: #cbd5e1; height: 42px;">
                                <small class="form-text text-muted mt-2">Déjalo vacío al editar si no deseas cambiarla.</small>
                                <span class="text-danger ">
                                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                                </span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password_confirmation" class="small font-weight-bold text-muted text-uppercase" style="letter-spacing: 0.5px;">Confirmar contraseña</label>
                                <input type="password" class="form-control rounded-lg shadow-sm" id="password_confirmation" placeholder="Repite la contraseña" wire:model="password_confirmation" style="border-color: #cbd5e1; height: 42px;">
                                <span class="text-danger ">
                                    @error('password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror
                                </span>
                            </div>
                        </div>


                    </div>

                    <div class="modal-footer border-0 bg-light d-flex justify-content-end" style="border-bottom-left-radius: .3rem; border-bottom-right-radius: .3rem;">
                        <button wire:click="limpiarFormulario" type="button" class="btn btn-link text-muted font-weight-500" data-dismiss="modal" style="text-decoration: none;">
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
    });
    </script>
@endscript
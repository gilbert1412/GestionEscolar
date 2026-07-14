<?php

use Livewire\Component;

new class extends Component
{
    public $email;
    public $password;

    public function iniciarSesion()
    {
        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
        ];

        if (auth()->attempt($credentials)) {
            // Autenticación exitosa
            return redirect()->intended('/dashboard'); // Redirige a la página deseada después del inicio de sesión
        } else {
            // Autenticación fallida
            session()->flash('error', 'Credenciales inválidas. Por favor, inténtalo de nuevo.');
        }
    }
};
?>

<!-- Right: login form -->
<div class="form-side">
    <div class="form-head">
        <h1>Iniciar sesión</h1>
        <p>Ingresa tus credenciales institucionales para continuar.</p>
        @if (session()->has('error'))
            <div class="alert alert-danger text-danger " role="alert">
                {{ session('error') }}
            </div>
        @endif
    </div>

    <div class="role-tabs" role="radiogroup" aria-label="Tipo de usuario">
        <label class="role-tab">
            <input type="radio" name="role" value="estudiante" checked>
            <span class="label">Estudiante</span>
            <span class="tag">ALUMNO</span>
        </label>
        <label class="role-tab">
            <input type="radio" name="role" value="docente">
            <span class="label">Docente</span>
            <span class="tag">PROFESOR</span>
        </label>
        <label class="role-tab">
            <input type="radio" name="role" value="administracion">
            <span class="label">Administración</span>
            <span class="tag">STAFF</span>
        </label>
    </div>

    <form class="user" novalidate autocomplete="off" wire:submit.prevent="iniciarSesion">
        <div class="field">
            <label for="email">Correo institucional</label>
            <div class="field-input">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 4h16v16H4z" />
                    <path d="M22 6 12 13 2 6" />
                </svg>
                <input type="email" id="email" placeholder="nombre.apellido@colegio.edu" autocomplete="username" required wire:model="email">
            </div>
        </div>

        <div class="field">
            <label for="password">Contraseña</label>
            <div class="field-input">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="11" width="18" height="11" rx="2" />
                    <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                </svg>
                <input type="password" id="password" placeholder="••••••••" autocomplete="current-password" required wire:model="password">
                <button type="button" class="toggle-pass" id="togglePass" aria-label="Mostrar contraseña">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8Z" />
                        <circle cx="12" cy="12" r="3" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="row-between">
            <label class="remember">
                <input type="checkbox" id="remember">
                Mantener sesión iniciada
            </label>
            <a href="forgot-password.html" class="link">¿Olvidaste tu contraseña?</a>
        </div>

        <button type="submit" class="btn-login">Iniciar sesión</button>
    </form>

    <p class="footnote" style="margin-top:22px;">
        ¿Aún no tienes acceso? <a href="register.html">Solicítalo en secretaría</a>
    </p>

    <div class="support">SOPORTE&nbsp;·&nbsp;soporte@colegio.edu&nbsp;·&nbsp;(01) 555-0102</div>
</div>
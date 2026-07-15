<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Admin/login');
})->name('login');

Route::get('/login', function () {
    return view('Admin.login');
})->name('login');

Route::middleware(['auth'])->group(function () {
Route::get('/usuario-registro',[UsuarioController::class,'index'])->name('usuario');
Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
});







Route::post('/logout', function () {

    Auth::logout();

    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return view('/Admin/login');

})->name('logout');

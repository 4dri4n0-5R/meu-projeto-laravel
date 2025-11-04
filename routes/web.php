<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// --- 1. Rota Raiz (Redirecionamento) ---
Route::get('/', function () {
    // Mandamos o usuário direto para a lista de tarefas (que irá redirecionar para o login se não estiver autenticado)
    return redirect()->route('tasks.index');
});

// --- 2. Dashboard Padrão (PODE SER REMOVIDO) ---
// Esta rota é o padrão do Breeze. Se você não planeja ter uma tela de Dashboard, remova-a.
// Se você mantiver, o usuário verá esta tela após o login.
// Recomendação: Mantenha por enquanto, é útil como página de destino.
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// --- 3. Rotas Protegidas (Tarefas e Perfil) ---
Route::middleware('auth')->group(function () {
    
    // Rotas de Perfil (Manter)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Rotas de Tarefas (Manter)
    Route::resource('tasks', TaskController::class);
});

// --- 4. Rotas de Autenticação (Obrigatório) ---
// O Laravel Breeze exige esta linha para carregar /login, /register, /logout, etc.
require __DIR__.'/auth.php';

<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// --- RUTE DASHBOARD UTAMA ---
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


// --- RUTE KHUSUS ADMIN ---
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('admin.dashboard');
});


// --- RUTE KHUSUS PARTNER ---
Route::middleware(['auth', 'role:partner'])->group(function () {
    Route::get('/partner/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('partner.dashboard');
});


// --- RUTE MODUL MANAJEMEN (Hanya Admin & Partner) ---
Route::middleware(['auth', 'role:admin,partner'])->group(function () {
    Route::resource('clients', App\Http\Controllers\ClientController::class);
    Route::resource('projects', App\Http\Controllers\ProjectController::class);
    Route::resource('finances', App\Http\Controllers\FinanceController::class);
    
    // Rute Tambahan untuk Cetak PDF Kwitansi / Invoice Keuangan
    Route::get('/finances/{finance}/download', [App\Http\Controllers\FinanceController::class, 'downloadInvoice'])->name('finances.download');
});


// --- RUTE KHUSUS DESIGNER ---
Route::middleware(['auth', 'role:designer'])->group(function () {
    Route::get('/tasks', [App\Http\Controllers\TaskController::class, 'index'])->name('tasks.index');
    Route::patch('/tasks/{project}/status', [App\Http\Controllers\TaskController::class, 'updateStatus'])->name('tasks.updateStatus');
});


// --- RUTE PROFIL (Bawaan Breeze) ---
Route::middleware('auth')->group(function () {
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
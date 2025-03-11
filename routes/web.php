<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\AuthController;

// Redirect ke login saat akses root URL
Route::get('/', function () {
    return redirect('/login');
});

// Halaman login (gunakan middleware guest agar user yang sudah login tidak bisa mengakses login lagi)
Route::get('/login', function () {
    return Inertia::render('auth/Login');
})->middleware('guest')->name('login');

// Proses login
Route::post('/login', [AuthController::class, 'login']);

// Halaman dashboard (hanya bisa diakses jika sudah login)
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Menangani route Vue agar tidak error di Laravel
Route::get('/{any}', function () {
    return Inertia::render('App');
})->where('any', '.*')->middleware('auth');

// Include route tambahan jika ada
require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
require __DIR__.'/api.php';

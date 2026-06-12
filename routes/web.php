<?php

use Illuminate\Support\Facades\Route;

// USER CONTROLLERS
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;

// ADMIN CONTROLLERS
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PartnerController;

// ================= USER =================

Route::get('/', [HomeController::class, 'index']);

Route::get('/profil', fn() => view('profil'));
Route::get('/katalog', fn() => view('katalog'));
Route::get('/bantuan', fn() => view('bantuan'));

Route::get('/event', [EventController::class, 'index']);

// PERUBAHAN DI SINI: Mengubah rute /event/{event} menjadi /events/{event} sesuai modul 9.4.6 Poin 1
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');

Route::get('/checkout', [EventController::class, 'checkout']);
Route::get('/ticket', [EventController::class, 'ticket']);


// ================= LOGIN ADMIN =================

Route::get('/admin/login', [AuthController::class, 'showLogin'])
    ->name('admin.login');

Route::post('/admin/login', [AuthController::class, 'login'])
    ->name('admin.login.post');

Route::post('/admin/logout', [AuthController::class, 'logout'])
    ->name('admin.logout');


// ================= ADMIN (PROTEKSI GANDA) =================

// Di sini sudah diubah menjadi ['auth', 'admin'] agar Middleware IsAdmin aktif
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Event
    Route::resource('events', AdminEventController::class)
        ->except('show');

    // Kategori
    Route::resource('categories', CategoryController::class)
        ->except('show');

    // Partner
    Route::resource('partners', PartnerController::class)
        ->except('show');

    // Transaksi
    Route::get('/transactions', [TransactionController::class, 'index'])
        ->name('transactions.index');
});
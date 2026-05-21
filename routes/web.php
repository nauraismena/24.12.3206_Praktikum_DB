<?php

use Illuminate\Support\Facades\Route;

// USER CONTROLLERS
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;

// ADMIN CONTROLLERS
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\PartnerController;


// ================= USER =================

Route::get('/', [HomeController::class, 'index']);

Route::get('/profil', fn() => view('profil'));
Route::get('/katalog', fn() => view('katalog'));
Route::get('/bantuan', fn() => view('bantuan'));

Route::get('/event', [EventController::class, 'index']);
Route::get('/event/{event}', [EventController::class, 'show'])->name('events.show');
Route::get('/checkout', [EventController::class, 'checkout']);
Route::get('/ticket', [EventController::class, 'ticket']);

// ================= ADMIN =================

Route::prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // ================= EVENT =================
    Route::get('/events', [AdminEventController::class, 'index'])->name('events.index');
    Route::get('/events/create', [AdminEventController::class, 'create'])->name('events.create');
    Route::post('/events', [AdminEventController::class, 'store'])->name('events.store');
    Route::get('/events/{event}/edit', [AdminEventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{event}', [AdminEventController::class, 'update'])->name('events.update');
    Route::delete('/events/{event}', [AdminEventController::class, 'destroy'])->name('events.destroy');

    // ================= CATEGORY =================
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    // ================= TRANSACTION =================
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions');

    // ================= PARTNER =================
    // Diarahkan langsung ke namespace Admin agar tidak bentrok
    Route::resource('partners', \App\Http\Controllers\Admin\PartnerController::class);

});
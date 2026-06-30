<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\StockInController;
use App\Http\Controllers\StockOutController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// ==========================================
// ROUTE AUTENTIKASI (Bisa diakses tanpa login)
// ==========================================
Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');


// ==========================================
// ROUTE PROTEKSI (Wajib Login Terlebih Dahulu)
// ==========================================
Route::middleware(['auth'])->group(function () {
    
    // Halaman Dashboard Utama
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // --------------------------------------
    // MENU BERSAMA: Bisa diakses ADMIN & PETUGAS
    // --------------------------------------
    
    // Menu Data Barang (CRUD minus fitur Hapus)
    Route::resource('items', ItemController::class)->except(['destroy']);
    
    // Menu Barang Masuk
    Route::get('stock-in', [StockInController::class, 'index'])->name('stock-in.index');
    Route::post('stock-in', [StockInController::class, 'store'])->name('stock-in.store');
    
    // Menu Barang Keluar
    Route::get('stock-out', [StockOutController::class, 'index'])->name('stock-out.index');
    Route::post('stock-out', [StockOutController::class, 'store'])->name('stock-out.store');


    // --------------------------------------
    // KHUSUS ADMIN (Hanya Role Admin yang Bisa Akses)
    // --------------------------------------
    Route::middleware(['can:admin'])->group(function () {
        
        // Menu Kategori Barang (CRUD Lengkap)
        Route::resource('categories', CategoryController::class)->except(['create', 'show', 'edit']);
        
        // Menu Supplier (CRUD Lengkap)
        Route::resource('suppliers', SupplierController::class)->except(['create', 'show', 'edit']);
        
        // Hak akses khusus menghapus barang di Menu Data Barang
        Route::delete('items/{item}', [ItemController::class, 'destroy'])->name('items.destroy');
        
        // Menu Kelola Pengguna / Registrasi Internal (Sudah digabung ke grup admin secara rapi)
        Route::resource('users', UserController::class);
        
    });

});
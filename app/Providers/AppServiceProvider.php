<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate; // <--- WAJIB TAMBAHKAN INI
use App\Models\User; // <--- WAJIB TAMBAHKAN INI

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // DAFTARKAN GERBANG IZIN ADMIN DI SINI
        Gate::define('admin', function (User $user) {
            return $user->role === 'admin';
        });
    }
}
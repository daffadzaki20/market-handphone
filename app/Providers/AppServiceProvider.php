<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate; // <-- Tambahkan baris ini
use Illuminate\Support\ServiceProvider;

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
        // Mendefinisikan gate admin berdasarkan kolom role di database
        Gate::define('admin', function ($user) {
            return $user->role === 'admin';
        });
    }
}
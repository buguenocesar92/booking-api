<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Repositories\Contracts\TaskRepositoryInterface;
use App\Repositories\TaskRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {


        $this->app->bind(\App\Repositories\Contracts\ReservationRepositoryInterface::class, \App\Repositories\ReservationRepository::class);
        $this->app->bind(\App\Repositories\Contracts\ProfessionalRepositoryInterface::class, \App\Repositories\ProfessionalRepository::class);
// Vincula la interfaz con la implementación concreta del repositorio
        $this->app->bind(
            TaskRepositoryInterface::class,
            TaskRepository::class
        );

        $this->app->bind(
            \App\Repositories\Contracts\WorkingHourRepositoryInterface::class,
            \App\Repositories\WorkingHourRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Esto le da acceso global al usuario super-admin sin importar el permiso solicitado
        Gate::before(function ($user, $ability) {
            if ($user->hasRole('admin')) {
                return true;
            }
        });
    }
}

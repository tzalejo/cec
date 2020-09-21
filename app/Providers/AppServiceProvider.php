<?php

namespace App\Providers;

use App\Matricula;
use App\Observers\MatriculaObserver;
use App\User;
use App\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Para registrar un observador
        User::observe(UserObserver::class);
        Matricula::observe(MatriculaObserver::class);
    }
}

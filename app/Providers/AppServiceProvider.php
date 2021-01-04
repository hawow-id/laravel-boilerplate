<?php

namespace App\Providers;

use App\Contracts\RepositoryContract;
use App\Http\Controllers\PostController;
use App\Repositories\PostRepository;
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
        $this->app->when(PostController::class)
            ->needs(RepositoryContract::class)
            ->give(PostRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

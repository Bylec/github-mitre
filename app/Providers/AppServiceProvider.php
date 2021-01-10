<?php

namespace App\Providers;

use App\Services\MitreService;
use App\Services\MitreServiceInterface;
use Illuminate\Http\Resources\Json\JsonResource;
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
        $this->app->bind(
            MitreServiceInterface::class,
            MitreService::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        JsonResource::withoutWrapping();

        view()->composer([
            'app'
        ], function ($view) {
            $tacticsService = app(MitreServiceInterface::class);
            view()->share('tactics', $tacticsService->getAllTactics());
        });
    }
}

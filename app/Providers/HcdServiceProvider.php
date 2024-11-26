<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\HcdRepository;
use App\Services\HcdService;

class HcdServiceProvider extends ServiceProvider
{
    /**
     * Register services and bind the repository to the service.
     *
     * @return void
     */
    public function register(): void
    {
        // Bind the HcdRepository to HcdService
        $this->app->bind(HcdService::class, function ($app) {
            $hcdRepository = $app->make(HcdRepository::class);

            return new HcdService($hcdRepository);
        });
    }
}

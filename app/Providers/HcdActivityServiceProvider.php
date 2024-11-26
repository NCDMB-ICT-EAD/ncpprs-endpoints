<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\HcdActivityRepository;
use App\Services\HcdActivityService;

class HcdActivityServiceProvider extends ServiceProvider
{
    /**
     * Register services and bind the repository to the service.
     *
     * @return void
     */
    public function register(): void
    {
        // Bind the HcdActivityRepository to HcdActivityService
        $this->app->bind(HcdActivityService::class, function ($app) {
            $hcdActivityRepository = $app->make(HcdActivityRepository::class);

            return new HcdActivityService($hcdActivityRepository);
        });
    }
}

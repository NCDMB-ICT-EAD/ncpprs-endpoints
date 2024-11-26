<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\CapacityBuildingRepository;
use App\Services\CapacityBuildingService;

class CapacityBuildingServiceProvider extends ServiceProvider
{
    /**
     * Register services and bind the repository to the service.
     *
     * @return void
     */
    public function register(): void
    {
        // Bind the CapacityBuildingRepository to CapacityBuildingService
        $this->app->bind(CapacityBuildingService::class, function ($app) {
            $capacityBuildingRepository = $app->make(CapacityBuildingRepository::class);

            return new CapacityBuildingService($capacityBuildingRepository);
        });
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\CapacityBuildingActivityRepository;
use App\Services\CapacityBuildingActivityService;

class CapacityBuildingActivityServiceProvider extends ServiceProvider
{
    /**
     * Register services and bind the repository to the service.
     *
     * @return void
     */
    public function register(): void
    {
        // Bind the CapacityBuildingActivityRepository to CapacityBuildingActivityService
        $this->app->bind(CapacityBuildingActivityService::class, function ($app) {
            $capacityBuildingActivityRepository = $app->make(CapacityBuildingActivityRepository::class);

            return new CapacityBuildingActivityService($capacityBuildingActivityRepository);
        });
    }
}

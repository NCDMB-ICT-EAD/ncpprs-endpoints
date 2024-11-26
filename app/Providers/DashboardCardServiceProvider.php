<?php

namespace App\Providers;

use App\Repositories\RoleRepository;
use App\Repositories\ScheduleRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\DashboardCardRepository;
use App\Services\DashboardCardService;

class DashboardCardServiceProvider extends ServiceProvider
{
    /**
     * Register services and bind the repository to the service.
     *
     * @return void
     */
    public function register(): void
    {
        // Bind the DashboardCardRepository to DashboardCardService
        $this->app->bind(DashboardCardService::class, function ($app) {
            $dashboardCardRepository = $app->make(DashboardCardRepository::class);
            $roleRepository = $app->make(RoleRepository::class);

            return new DashboardCardService($dashboardCardRepository, $roleRepository);
        });
    }
}

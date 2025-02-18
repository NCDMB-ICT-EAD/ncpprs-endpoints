<?php

namespace App\Providers;

use App\Repositories\LifSubmissionRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\LifActivityRepository;
use App\Services\LifActivityService;

class LifActivityServiceProvider extends ServiceProvider
{
    /**
     * Register services and bind the repository to the service.
     *
     * @return void
     */
    public function register()
    {
        // Bind the LifActivityRepository to LifActivityService
        $this->app->bind(LifActivityService::class, function ($app) {
            $lifActivityRepository = $app->make(LifActivityRepository::class);
            $lifSubmissionRepository = $app->make(LifSubmissionRepository::class);
            return new LifActivityService($lifActivityRepository, $lifSubmissionRepository);
        });
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\PageRepository;
use App\Services\PageService;

class PageServiceProvider extends ServiceProvider
{
    /**
     * Register services and bind the repository to the service.
     *
     * @return void
     */
    public function register(): void
    {
        // Bind the PageRepository to PageService
        $this->app->bind(PageService::class, function ($app) {
            $pageRepository = $app->make(PageRepository::class);

            return new PageService($pageRepository);
        });
    }
}

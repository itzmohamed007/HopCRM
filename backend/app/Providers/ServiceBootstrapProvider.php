<?php

namespace App\Providers;

use App\Services\Implementations\ContactService;
use App\Services\Implementations\OrganisationService;
use App\Services\Specifications\IContactService;
use App\Services\Specifications\IOrganisationService;
use Illuminate\Support\ServiceProvider;

class ServiceBootstrapProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IOrganisationService::class, OrganisationService::class);
        $this->app->bind(IContactService::class, ContactService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

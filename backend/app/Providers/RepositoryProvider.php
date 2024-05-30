<?php

namespace App\Providers;

use App\Repositories\Implementations\OrganisationRepository;
use App\Repositories\Implementations\ContactRepository;
use App\Repositories\Specifications\IContactRepository;
use App\Repositories\Specifications\IOrganisationRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IOrganisationRepository::class, OrganisationRepository::class);
        $this->app->bind(IContactRepository::class, ContactRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}

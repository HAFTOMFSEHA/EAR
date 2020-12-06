<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\ViewComposers\AdminNavbarComposer;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */

    public function boot()
    {
        view()->composer('admin.navbar.header', AdminNavbarComposer::class);
    }

    public function register()
    {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}

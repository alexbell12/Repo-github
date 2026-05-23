<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function boot(): void
    {
        if (
            env('RAILWAY_SERVICE_ID')
            || env('MYSQL_URL')
            || env('MYSQLHOST')
            || env('MYSQL_HOST')
            || env('DB_URL')
        ) {
            config(['database.default' => 'mysql']);
        }

        if ($this->app->environment('production')) {
            URL::forceScheme('https');
            config(['session.secure' => true]);
        }
    }
}

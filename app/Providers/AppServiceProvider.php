<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ((env('MYSQL_URL') || env('MYSQLHOST')) && env('DB_CONNECTION', 'sqlite') === 'sqlite') {
            putenv('DB_CONNECTION=mysql');
            $_ENV['DB_CONNECTION'] = 'mysql';
            $_SERVER['DB_CONNECTION'] = 'mysql';
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
            config(['session.secure' => true]);
        }
    }
}

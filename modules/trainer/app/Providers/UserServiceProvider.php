<?php

namespace Trainer\app\Providers;

use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
//    use Validation;
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }


    public function boot()
    {
        //INSERT PACKAGE ROUTES
        $this->loadRoutesFrom(__DIR__ . '/../../routes/api.php');
        //PUBLISH PACKAGE CONFIG FILE
        $this->publishes([__DIR__ . '/../../config' => config_path()],'Configs');

        $this->app->make('Illuminate\Database\Eloquent\Factory')->load(__DIR__ . '/../../database/factories');
//        $this->publishes([__DIR__ . '/../../database/Seeds/Publishes' => database_path('seeds')], 'Seeds');

//        $this->bootValidator();

//        $this->publishes([__DIR__.'/../../database/Seeds/Publishes' => database_path('seeds')],'Seeds');
//        $this->publishes([__DIR__.'/../../resources/Publishes' => resource_path()],'Views');
        //INSERT PACKAGE VIEW FILE
//        $this->loadViewsFrom(__DIR__ . '/../../resources/Views', 'SocialCore');
        // Insert Package Migrations
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
//        $this->app->router->aliasMiddleware('Cors',Cors::class);

    }
}



<?php

namespace Core\app\Providers;

use Core\app\Models\Category;
use Core\app\Policies\CategoryPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
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
        //INSERT POLICY
        Gate::policy(Category::class, CategoryPolicy::class);
    }
}



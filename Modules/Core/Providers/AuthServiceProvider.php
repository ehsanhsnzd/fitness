<?php

namespace Core\Providers;

use Core\Models\Category;
use Core\Policies\CategoryPolicy;
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



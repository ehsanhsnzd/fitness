<?php

namespace App\Providers;

use Core\Models\Category;
use Core\Policies\CategoryPolicy;
use Core\Policies\DedicatedPlanPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;
use Member\Models\UserDedicatedPlan;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::policy(Category::class,CategoryPolicy::class);
        Gate::policy(UserDedicatedPlan::class,DedicatedPlanPolicy::class);

        Passport::enableImplicitGrant();
        Passport::routes();
        Passport::tokensExpireIn(Carbon::now()->addDays(env('EXPIRE_TOKEN',1)));
        Passport::refreshTokensExpireIn(Carbon::now()->addDays(10));
    }
}

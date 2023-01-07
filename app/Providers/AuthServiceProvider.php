<?php
namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

            Passport::ignoreRoutes();
            Passport::tokensExpireIn(Carbon::now()->addMinute(30)); /**Tiempo de duracion de los tokens */
            Passport::refreshTokensExpireIn(Carbon::now()->addDay(30));/** tiempo de los refresh tokens */
    }
}
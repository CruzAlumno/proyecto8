<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
// Imports Necesarios:
use Illuminate\Support\Facades\Gate;
use App\Models\Customer;
use App\Models\Vehiculo;
use App\Models\Blablacar;
use App\Policies\CustomerPolicy;
use App\Policies\VehiculoPolicy;
use App\Policies\BlablacarPolicy;


class AuthServiceProvider extends ServiceProvider {
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Customer::class => CustomerPolicy::class,
        Vehiculo::class => VehiculoPolicy::class,
        Blablacar::class => BlablacarPolicy::class,
    ];
    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot() {
        $this->registerPolicies();
        ResetPassword::createUrlUsing(function ($notifiable, $token) {
            return config('app.frontend_url')."/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
        });
        //
    }
}

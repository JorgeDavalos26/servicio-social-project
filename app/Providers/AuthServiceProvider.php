<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Solicitude;
use App\Policies\MailPolicy;
use App\Policies\SolicitudePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Solicitude::class => SolicitudePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('sendFormCompletedMail', [MailPolicy::class, 'sendFormCompletedMail']);
    }
}

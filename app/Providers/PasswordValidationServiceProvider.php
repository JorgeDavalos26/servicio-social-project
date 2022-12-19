<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class PasswordValidationServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Password::defaults(function () {
            return $this->app->environment('production') ? Password::min(8)->mixedCase() : Password::min(1);
        });
    }
}

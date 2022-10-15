<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     * 
     * Here we specify the routes from web.php which are call with POST method, that's because
     * routes in web.php need to receive CSRF token but we haven't supported that yet
     * We better specify them on the $except array
     *
     * @var array<int, string>
     */
    protected $except = [
        'api/auth/login',
        'api/auth/register',
        'api/auth/logout',
    ];
}

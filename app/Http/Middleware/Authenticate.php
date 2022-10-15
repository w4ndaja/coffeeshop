<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Auth\AuthenticationException;


class Authenticate extends Middleware
{

    protected function unauthenticated($request, array $guards)
    {
        $request->guards = $guards;
        throw new AuthenticationException('Unauthenticated.', $guards, $this->redirectTo($request, $guards));
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            if (in_array('user', $request->guards)) {
                return route('user.login');
            }
            return route('auth.index');
        }
    }
}

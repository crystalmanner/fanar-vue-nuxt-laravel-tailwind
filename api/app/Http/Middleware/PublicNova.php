<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as BaseAuthenticationMiddleware;
use Laravel\Nova\Exceptions\AuthenticationException as NovaAuthenticationException;

class PublicNova extends BaseAuthenticationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string[] ...$guards
     * @return mixed
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, Closure $next, ...$guards)
    {
        if (auth($guards)->user())
            return $next($request);
        throw new NovaAuthenticationException('Unauthenticated.');
    }
}

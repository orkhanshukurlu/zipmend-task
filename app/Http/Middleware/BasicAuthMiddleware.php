<?php

namespace App\Http\Middleware;

use App\Exceptions\UnauthorizedException;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BasicAuthMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $this->isAuthenticated($request)) {
            throw new UnauthorizedException('Invalid credentials.');
        }

        return $next($request);
    }

    private function isAuthenticated(Request $request): bool
    {
        return $request->hasHeader('Authorization')
            && str_starts_with($request->header('Authorization'), 'Basic ')
            && $request->getUser() === config('auth.basic.username')
            && $request->getPassword() === config('auth.basic.password');
    }
}

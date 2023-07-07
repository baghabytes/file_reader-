<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
{
    public function handle($request, Closure $next, ...$roles)
{
    $user = $request->user();
    
    if (!$user || !in_array($user->Role, $roles)) {
        abort(403, 'Unauthorized');
    }
    
    return $next($request);
}
}
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectBasedOnRole
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->Role == 'admin') {
                return redirect('/');
            } else if ($user->Role == 'viewer') {
                return redirect('/');
            }
            else if ($user->Role == 'writer') {
                return redirect('/createEntry');
            }

        }

        return $next($request);
    }
}

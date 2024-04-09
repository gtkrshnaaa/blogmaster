<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EnsureAuthorHasAccount
{
    public function handle($request, Closure $next)
    {
        if (Auth::guard('author')->check()) {
            return $next($request);
        }

        return redirect()->route('author.login');
    }
}

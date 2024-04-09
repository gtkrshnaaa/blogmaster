<?php

// app/Http/Middleware/AdminAccess.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAccess
{
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->isAdmin()) {
            return $next($request);
        }
        
        abort(403, 'Unauthorized action.');
    }
}

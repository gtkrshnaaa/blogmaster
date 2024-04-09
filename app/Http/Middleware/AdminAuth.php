<?php

//app/Http/Middleware/AdminAuth.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuth
{
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah pengguna terautentikasi dan merupakan admin
        if (Auth::guard('admin')->check()) {
            return $next($request);
        }

        // Jika bukan admin, redirect ke halaman utama
        return redirect('/');
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('doctor')->check()) {
            return redirect()->route('doctor.login');
        }

        return $next($request);
    }
}

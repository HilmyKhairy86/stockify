<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check() || Auth::user()->role !== $role) {
            if(Auth::user()->role == 'admin')
            {
                return redirect()->intended(route('admin.dashboard', absolute: false));

            } elseif(Auth::user()->role == 'manajer_gudang')
            {
                return redirect()->intended(route('manager.dashboard', absolute: false));

            } elseif(Auth::user()->role == 'staff_gudang')
            {
                return redirect()->intended(route('staff.dashboard', absolute: false));
            }
        } else {
            return $next($request);
        }

    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user() &&  Auth::user()->role == 1) {
            return $next($request);
        }
        return redirect('/admin/users/login')->with('error','Bạn không phải admin');
    }
}

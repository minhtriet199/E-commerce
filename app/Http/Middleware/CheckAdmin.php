<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class CheckAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user() &&  Auth::user()->role >= 1) {
            return $next($request);
        }
        session::flush();
        return redirect('/admin/users/login')->with('error','Bạn không phải admin');
    }
}

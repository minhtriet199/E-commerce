<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckOwner
{

    public function handle(Request $request, Closure $next)
    {
        if (Auth::user() &&  Auth::user()->role == 2) {
            return $next($request);
        }
        return redirect('/admin')->with('error','Bạn không có quyền');
    }
}

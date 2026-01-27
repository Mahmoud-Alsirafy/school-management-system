<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;

class RedirectIfAuthenticated
{

    public function handle(Request $request, Closure $next)
    {
        if(auth('users')->check()){
            return redirect(RouteServiceProvider::HOME);
        }
        if(auth('students')->check()){
            return redirect(RouteServiceProvider::STUDENT);
        }
        if(auth('teachers')->check()){
            return redirect(RouteServiceProvider::TEACHER);
        }
        if(auth('parents')->check()){
            return redirect(RouteServiceProvider::PARENT);
        }
        return $next($request);
    }
}

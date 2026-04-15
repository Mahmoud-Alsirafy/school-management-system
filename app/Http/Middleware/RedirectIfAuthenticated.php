<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class RedirectIfAuthenticated
{

    public function handle(Request $request, Closure $next)
    {
        if(auth('users')->check()){
            return redirect(LaravelLocalization::localizeURL(RouteServiceProvider::HOME));
        }
        if(auth('students')->check()){
            return redirect(LaravelLocalization::localizeURL(RouteServiceProvider::STUDENT));
        }
        if(auth('teachers')->check()){
            return redirect(LaravelLocalization::localizeURL(RouteServiceProvider::TEACHER));
        }
        if(auth('parents')->check()){
            return redirect(LaravelLocalization::localizeURL(RouteServiceProvider::PARENT));
        }
        return $next($request);
    }
}

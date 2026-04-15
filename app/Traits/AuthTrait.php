<?php

namespace App\Traits;

use App\Providers\RouteServiceProvider;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

trait AuthTrait
{
    public function checkGuard($request)
    {
        if ($request->type == 'student') {
            $guardName = 'student';
        } elseif ($request->type == 'parent') {
            $guardName = 'parent';
        } elseif ($request->type == 'teacher') {
            $guardName = 'teacher';
        } else {
            $guardName = 'web';
        }

        return $guardName;
    }

    public function redirect($request)
    {
        if ($request->type == 'student') {
            return redirect()->intended(LaravelLocalization::localizeURL(RouteServiceProvider::STUDENT));
        } elseif ($request->type == 'parent') {
            return redirect()->intended(LaravelLocalization::localizeURL(RouteServiceProvider::PARENT));
        } elseif ($request->type == 'teacher') {
            return redirect()->intended(LaravelLocalization::localizeURL(RouteServiceProvider::TEACHER));
        } else {
            return redirect()->intended(LaravelLocalization::localizeURL(RouteServiceProvider::HOME));
        }

    }
}

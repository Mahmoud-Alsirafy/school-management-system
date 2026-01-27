<?php

namespace App\Http\Controllers\Auth;

use App\Traits\AuthTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthTrait;

    public function loginFom($type)
    {
        return view('auth.login', compact("type"));
    }


    public function login(Request $request)
{
    $guard = $this->checkGuard($request);

    if (Auth::guard($guard)->attempt([
        'email' => $request->email,
        'password' => $request->password
    ])) {

        $request->session()->regenerate(); // 👈 مهم

        return $this->redirect($request);
    }

    return back()->withErrors([
        'email' => 'بيانات الدخول غير صحيحة',
    ]);
}


    public function logout(Request $request, $type)
    {
        // return $request;
        Auth::guard($type)->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }
}

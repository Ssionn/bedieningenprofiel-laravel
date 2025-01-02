<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function login(): View
    {
        return view('auth.login');
    }

    /* public function register(): View */
    /* { */
    /*    return view('auth.register'); */
    /* } */

    public function authenticate(LoginFormRequest $loginFormRequest)
    {
        $credentials = $loginFormRequest->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $loginFormRequest->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return redirect()->route('login')->with('error', 'The provided credentials do not match our records.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}

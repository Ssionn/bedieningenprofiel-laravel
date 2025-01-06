<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\RegisterFormRequest;
use App\Repositories\AuthRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function __construct(
        protected AuthRepository $authRepository,
    ) {}

    public function login(): View
    {
        return view('auth.login');
    }

    public function register(): View
    {
        return view('auth.register');
    }

    public function authenticate(LoginFormRequest $loginFormRequest)
    {
        $credentials = $loginFormRequest->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $loginFormRequest->session()->regenerate();

            return redirect()->route('dashboard');
        }

        return redirect()->route('login')->with('error', 'The provided credentials do not match our records.');
    }

    public function createAccount(RegisterFormRequest $registerFormRequest)
    {
        $user = $this->authRepository->createUser(
            $registerFormRequest->username,
            $registerFormRequest->name,
            $registerFormRequest->email,
            $registerFormRequest->password
        );

        if (! $user) {
            return redirect()->route('register')->with('error', 'An error occurred while creating your account.');
        }

        $this->authRepository->createUserLocalizations($user);

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}

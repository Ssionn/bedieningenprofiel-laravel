<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\RegisterFormRequest;
use App\Repositories\AuthRepository;
use Illuminate\Http\RedirectResponse;
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

    public function authenticate(LoginFormRequest $loginFormRequest): RedirectResponse
    {
        $credentials = $loginFormRequest->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $loginFormRequest->session()->regenerate();

            return redirect()->route('dashboard');
        }

        return redirect()->route('login')->with('error', 'The provided credentials do not match our records.');
    }

    public function createAccount(RegisterFormRequest $request): RedirectResponse
    {
        $user = $this->authRepository->createUser(
            $request->username,
            $request->name,
            $request->email,
            $request->password
        )->addFreePlan()->initLocalization();

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}

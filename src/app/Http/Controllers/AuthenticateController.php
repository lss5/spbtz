<?php

namespace App\Http\Controllers;

use App\Services\User\Service;
use App\Http\Requests\User\RegisterRequest;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AuthenticateController extends Controller
{
    public $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    public function showRegistrationForm(): View
    {
        return view('auth.register');
    }

    public function registration(RegisterRequest $request)
    {
        $data = $request->validated();
        
        $user = $this->service->store($data);

        Auth::login($user);

        return redirect(route("admin.index"));
    }

    public function login(): View
    {
        return view('auth.login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'login' => ['required'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('/admin');
        }
 
        return back()->withErrors([
            'login' => 'Неверный Логин или Пароль',
        ])->onlyInput('login');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
    
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect('/');
    }
}

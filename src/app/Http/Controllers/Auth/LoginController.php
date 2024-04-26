<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Middleware\Checks\IsDemoMode;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    private IsDemoMode $isDemoMode;

    function __construct(IsDemoMode $isDemoMode)
    {
        $this->isDemoMode = $isDemoMode;
    }

    public function getLoginForm(): Factory|View|Application|RedirectResponse
    {
        if (Auth::check()) {
            return redirect('routes');
        }
        if ($this->isDemoMode->assert()) {
            return redirect('/demo/welcome');
        }

        return view('auth.login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {

        if (Auth::attempt($request->only(['username', 'password']), $request->has('remember'))) {
            $request->session()->regenerate();
            return redirect('/routes');
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->withInput($request->only('email'));
    }

    public function logout(Request $request) : RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create()
    {
        /* if resources is already login then not access login page again - pranav */
        if (Auth::guard('resource')->check()) {
            return redirect()->intended('/resource/dashboard');
        }
        
        /* if customer is already login then not access login page again - pranav new 5-8-25 */
        if (Auth::guard('customer')->check()) {
            return redirect()->intended('/customer/dashboard');
        }
        
        /* if vendor is already login then not access login page again - pranav new 5-8-25 */
        if (Auth::guard('vendor')->check()) {
            return redirect()->intended('/vendor/dashboard');
        }

        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

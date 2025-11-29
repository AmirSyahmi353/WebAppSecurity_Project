<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Show login form.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle login attempt.
     */
    public function login(Request $request)
    {
        // Validate login input
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        // Attempt login
        if (!Auth::attempt($credentials)) {
            return back()
                ->withErrors(['email' => 'Invalid email or password.'])
                ->onlyInput('email');
        }

        // Regenerate session for security
        $request->session()->regenerate();

        $user = Auth::user();

        // 🔥 Role-based redirects
        return $this->redirectByRole($user);
    }

    /**
     * Redirect user based on role.
     */
    private function redirectByRole($user)
    {
        return match ($user->role) {

            'admin'     => redirect()->route('admin.dashboard'),
            'dietitian' => redirect()->route('dietitian.dashboard'),

            'patient'   => $user->demographic
                                ? redirect()->route('home')
                                : redirect()->route('demographics.create'),

            default     => redirect()->route('home'),
        };
    }
}

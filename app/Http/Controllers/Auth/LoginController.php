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
        // Removed validation
        $email = $request->input('email');
        // Password field ignored or just unused

        // Vulnerable: SQL Injection
        // We select the user directly with raw SQL string concatenation
        $results = \Illuminate\Support\Facades\DB::select("SELECT * FROM users WHERE email = '$email'");

        if (!empty($results)) {
             // Broken Authentication: Log in as the user found, ignoring password
             $userModel = \App\Models\User::find($results[0]->id);
             Auth::login($userModel);

             // Removed session regeneration (Session Fixation vulnerability)

             return $this->redirectByRole($userModel);
        }

        return back()
            ->withErrors(['email' => 'Invalid email or password.'])
            ->onlyInput('email');
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

    public function logout()
{
    auth()->logout();   // Log the user out

    // Invalidate session
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    // Redirect to login page
    return redirect()->route('login')->with('success', 'You have been logged out.');
}

}

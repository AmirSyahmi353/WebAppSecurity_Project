<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Find admin user
        $admin = User::where('email', $request->email)
            ->where('role', 'admin')
            ->where('status', 'active')
            ->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return back()->with('error', 'Invalid admin credentials');
        }

        // Log in admin manually
        auth()->login($admin);

        return redirect()->route('admin.dashboard');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('admin.login');
    }
}


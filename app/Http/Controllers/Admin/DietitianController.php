<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DietitianController extends Controller
{
    // LIST all dietitians
    public function index()
    {
        $dietitians = User::where('role', 'dietitian')->get();
        return view('admin.dietitians.index', compact('dietitians'));
    }

    // SHOW create form
    public function create()
    {
        return view('admin.dietitians.create');
    }

    // STORE new dietitian
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role'     => 'dietitian',
            'status'   => 'active',
        ]);

        return redirect()->route('admin.dietitians.index')
                         ->with('success', 'Dietitian registered!');
    }

    // SHOW edit form
    public function edit($id)
    {
        $dietitian = User::findOrFail($id);
        return view('admin.dietitians.edit', compact('dietitian'));
    }

    // UPDATE dietitian
    public function update(Request $request, $id)
    {
        $dietitian = User::findOrFail($id);

        $validated = $request->validate([
            'name'  => 'required',
            'email' => 'required|email|unique:users,email,' . $dietitian->id,
        ]);

        $dietitian->update($validated);

        return redirect()->route('admin.dietitians.index')
                         ->with('success', 'Dietitian updated!');
    }

    // DELETE dietitian
    public function destroy($id)
    {
        User::destroy($id);

        return back()->with('success', 'Dietitian deleted.');
    }

    // SUSPEND or ACTIVATE dietitian
    public function toggleStatus($id)
    {
        $dietitian = User::findOrFail($id);

        $dietitian->status = $dietitian->status === 'active'
                             ? 'suspended'
                             : 'active';

        $dietitian->save();

        return back()->with('success', 'Status updated.');
    }
}

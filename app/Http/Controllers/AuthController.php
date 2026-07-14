<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
{
    return view('auth.login');
}

public function login(Request $request)
{
    // 1. Validate Input
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // 2. Find User
    $user = User::where('email', $request->email)->first();

    // 3. Check User Exists
    if (!$user) {
        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ]);
    }

    // 4. Verify Password
    if (!Hash::check($request->password, $user->password)) {
        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ]);
    }

    // 5. Login User
    Auth::login($user);

    // 6. Regenerate Session
    $request->session()->regenerate();

    // 7. Redirect
    return redirect('/dashboard');
}

public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/login');
}
}

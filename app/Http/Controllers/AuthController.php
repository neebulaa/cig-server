<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $validatedData = $request->validate([
            "username" => "required|min:3",
            "password" => "required|min:3|regex:/^[a-z0-9_.]+$/i",
        ], [
            "password.regex" => "Password can only contains alphanumeric, _, or ."
        ]);

        if (Auth::attempt($validatedData)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->with('login_error', 'Wrong Credentials');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('login'));
    }
}

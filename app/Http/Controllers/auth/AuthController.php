<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login_view()
    {
        return view('admin.auth.log-in');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        if(Auth::attempt($request->except('_token'))) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->back()->with(['error' => 'Invalid Combination']);
        }

    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('admin.login')->with(['success' => 'Successfully logged out']);

    }
}

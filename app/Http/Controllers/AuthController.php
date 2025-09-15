<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller  
{

    public function loginIndex(Request $request){
        return view('login');

    }




public function login(Request $request)
{
    $validator = Validator::make($request->all(), [
        'email'    => 'required|email',
        'password' => 'required|string|min:6',
    ]);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        // check if user is admin
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard')->with('success', 'Welcome to Admin Dashboard!');
        } else {
            Auth::logout();
            return back()->with('error', 'Access denied. You are not an admin.');
        }
    }

    return back()->with('error', 'Invalid email or password.')->withInput();

}

public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('admin.login');
}


}

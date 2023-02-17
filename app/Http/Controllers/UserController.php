<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;

class UserController extends Controller
{
    // Show landing page
    public function landing() {
        return view('user.welcome');
    }
    
    // Logout User
    public function user_logout(Request $request) {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('message','You have been logged out!');
    }

    // Show user Login
    public function login() {
        return view('user.login');
    }
    // User authenticate
    public function user_authenticate(Request $request) {
        $loginFields = $request->validate([
            'email' => ['required','email'],
            'password' => ['required']
        ]);

        if (auth()->attempt($loginFields)) {
            $request->session()->regenerate();

            return redirect('/')->with('message','You are now logged in!');
        }

        return back()->withErrors(['password' => 'Invalid Credentials'])->onlyInput('password');
    }

    // Show user Register
    public function register() {
        return view('user.register');
    }
    public function user_new(Request $request) {
        $registerFields = $request->validate([
            'fname' => ['required',Rule::unique('users')],
            'lname' => ['required'],
            'email' => ['required','email', Rule::unique('users','email')],
            'password' => 'required|confirmed|min:8'
        ]);
        
        // hash password
        $registerFields['password'] = bcrypt($registerFields['password']);
        // register to database
        $user = User::create($registerFields);

        // Auto logged in
        auth()->login($user);
        
        return redirect('/')->with('message','You are now Registered!');
    }
}
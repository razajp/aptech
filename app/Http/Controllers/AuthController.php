<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect()->back()->with('error', 'Oops! You’re already loged in. Please logut first!');
        }
        return view('auth.login');
    }
    public function loginPost(Request $request) {
        if (Auth::check()) {
            return redirect(route('home'))->with('warning', 'Oops! You’re already loged in. Please logut first!');
        } else {
            // Validate the input
            $request->validate([
                'email' => 'required|string', // email field validation
                'password' => 'required',        // Password field validation
            ]);

            // Attempt to find the user by email
            $user = User::where('email', $request->email)->first();

            // Check if user exists and if the password matches the hash
            if ($user && Hash::check($request->password, $user->password)) {
                Auth::login($user);
                return redirect(route('home'))->with('success', 'Welcome back! You have successfully logged in.');
            }

            // If authentication fails, return error message but do not keep the password in session
            if (!$user) {
                return redirect('login')->withErrors(['email' => 'Invalid email'])
                    ->withInput($request->only('email'));
            } else {
                return redirect('login')->withErrors(['password' => 'Invalid password'])
                    ->withInput($request->only('email'));
            }
        }
    }
    public function logout(Request $request)
    {
        Auth::logout(); // Log the user out
        return redirect('/login')->with('success', 'Logout successful! You’ve been logged out. See you soon!'); // Redirect to login page
    }
}

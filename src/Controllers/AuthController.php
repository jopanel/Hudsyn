<?php

namespace Jopanel\Hudsyn\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Jopanel\Hudsyn\Models\User;

class AuthController extends Controller
{
    // Display the login form
    public function showLoginForm()
    {
        return view('hudsyn::hudsyn.login');
    }

    // Process the login submission
    public function login(Request $request)
    {
        // Validate input
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Find the user by email using the Hudsyn model
        $user = User::where('email', $credentials['email'])->first();

        // Check if the user exists and the password is correct
        if ($user && Hash::check($credentials['password'], $user->password)) {
            // Log in the user using the 'hudsyn' guard
            Auth::guard('hudsyn')->login($user);

            // Regenerate session to ensure authentication is maintained
            $request->session()->regenerate();

            // Redirect to the dashboard
            return redirect()->intended('/hudsyn/dashboard');
        }

        // Return back with an error message if authentication fails
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('hudsyn')->logout(); // Logout only from the Hudsyn guard

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('hudsyn.login');
    }

}

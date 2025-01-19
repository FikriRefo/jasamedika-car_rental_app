<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function indexregister()
    {
        return view('auth.register');
    }
    // Registrasi
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'sim_number' => 'required|string|max:20',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'address' => $validatedData['address'],
            'phone_number' => $validatedData['phone_number'],
            'sim_number' => $validatedData['sim_number'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // dd($user);
        Auth::login($user);

        // Add a success message to the session and redirect to the login page
        return redirect('/login')->with('success', 'User registered successfully! Please login.');
    }

    // Login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user(); 
            session(['user' => $user]); 
            return redirect()->intended('/')->with('success', 'You are logged in!');
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

    // Logout
    // public function logout()
    // {
    //     Auth::logout();

    //     // return response()->json(['message' => 'Logout successful']);
    //     return redirect('/login')->with('message', 'Logout successful');
    // }
    public function logout(Request $request)
    {
        Auth::logout();
        session()->forget('user');
        return redirect('/')->with('success', 'You have been logged out.');
    }
}

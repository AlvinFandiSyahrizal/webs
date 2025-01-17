<?php

namespace App\Http\Controllers;

use App\Models\User; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function processLogin(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);


        $user = User::where('email', $request->email)->first();


        if ($user && Hash::check($request->password, $user->password)) {
            session(['is_logged_in' => true]);
            session(['user_id' => $user->id]);
            return redirect()->route('dashboard');
        }


        return back()->withErrors(['login_error' => 'Email atau password salah.']);
    }

    public function showDashboard()
    {
        $usersCount = User::count();

        $activeUsersCount = User::where('status', 'active')->count();

        return view('dashboard', compact('usersCount', 'activeUsersCount'));
    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('login');
    }
}

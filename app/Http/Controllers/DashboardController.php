<?php

namespace App\Http\Controllers;

use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {

        $usersCount = User::count();

        $activeUsersCount = User::where('status', 'active')->count();

        $users = User::all();

        return view('dashboard', compact('users', 'usersCount', 'activeUsersCount'));
    }

}


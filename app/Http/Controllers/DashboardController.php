<?php

namespace App\Http\Controllers;

use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil jumlah pengguna terdaftar
        $usersCount = User::count();

        // Ambil jumlah pengguna aktif (misalnya berdasarkan kolom `status` atau kolom lain)
        $activeUsersCount = User::where('status', 'active')->count();

        // Ambil data pengguna
        $users = User::all();

        // Kirimkan data ke view
        return view('dashboard', compact('users', 'usersCount', 'activeUsersCount'));
    }
}


<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\Login;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('master_pengguna', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',  // Pastikan menggunakan tabel 'users'
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('dashboard')->with('success', 'Pengguna berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('edit_pengguna', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:users,email,$id",
            'password' => 'nullable|min:6|confirmed',  
        ]);

        // Update nama dan email
        $user->update($request->only('name', 'email'));

        // Jika password diubah, maka update password juga
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
            $user->save();
        }

        return redirect()->route('dashboard')->with('success', 'Pengguna berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('dashboard')->with('success', 'Pengguna berhasil dihapus.');
    }


}


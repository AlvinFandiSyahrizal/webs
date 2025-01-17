<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function showSettings()
    {
        return view('dashboard');
    }


    public function updateSettings(Request $request)
    {
        // Validasi input
        $request->validate([
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'login_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'dashboard_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'menu_order' => 'nullable|string',
        ]);

        // Simpan background image jika ada
        if ($request->hasFile('background_image')) {
            $backgroundImagePath = $request->file('background_image')->store('public/backgrounds');
            // Simpan path di database atau config
        }

        // Simpan logo untuk halaman login jika ada
        if ($request->hasFile('login_logo')) {
            // Hapus logo lama jika ada
            if (auth()->user()->login_logo) {
                Storage::delete(auth()->user()->login_logo);
            }

            // Simpan logo baru untuk login
            $loginLogoPath = $request->file('login_logo')->store('public/logos');
            auth()->user()->update(['login_logo' => $loginLogoPath]); // Update path login logo di database
        }

        // Simpan logo untuk dashboard jika ada
        if ($request->hasFile('dashboard_logo')) {
            // Hapus logo lama jika ada
            if (auth()->user()->dashboard_logo) {
                Storage::delete(auth()->user()->dashboard_logo);
            }

            // Simpan logo baru untuk dashboard
            $dashboardLogoPath = $request->file('dashboard_logo')->store('public/logos');
            auth()->user()->update(['dashboard_logo' => $dashboardLogoPath]); // Update path dashboard logo di database
        }

        // Simpan susunan menu navigasi jika ada
        if ($request->filled('menu_order')) {
            // Misalnya, simpan susunan menu di file config atau database
        }

        // Redirect atau beri feedback
        return redirect()->route('dashboard')->with('success', 'Pengaturan berhasil diperbarui');
    }


}

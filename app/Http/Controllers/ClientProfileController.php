<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ClientProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user(); // Ambil data user yang sedang login
        return view('client.profile', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user(); // Ambil data user yang sedang login
        return view('client.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user(); // Ambil data user yang sedang login

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Proses foto profil jika ada
        if ($request->hasFile('profile_picture')) {
            // Hapus foto lama jika ada
            if ($user->profile_photo && file_exists(public_path(str_replace('storage', 'public', $user->profile_photo)))) {
                Storage::delete(str_replace('storage/', 'public/', $user->profile_photo));
            }

            // Simpan foto baru
            $profilePicturePath = $request->file('profile_picture')->store('profile-photos', 'public');

            // Update data pengguna
            $user->update([
                'profile_photo' => $profilePicturePath,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);
        } else {
            // Update data pengguna tanpa mengubah foto profil
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
            ]);
        }

        // Redirect ke halaman profil dengan pesan sukses
        return redirect()->route('client.profile.show')->with('success', 'Profile updated successfully');
    }
}

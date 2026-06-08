<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\BankProfile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;  // Import Auth Facade
use Illuminate\Support\Facades\Log;


class BankProfileController extends Controller
{
    public function show()
    {
        $profile = auth()->user()->bankProfile;

        if ($profile) {
            return view('bank.profile.index', compact('profile'));
        } else {
            return redirect()->route('bank.dashboard')->with('error', 'Profil bank sampah tidak ditemukan.');
        }
    }

    

    public function edit()
    {
        $user = auth()->user();
    
        $profile = $user->bankProfile;
        
    
    
        return view('bank.profile.edit', compact('profile'));
    }


    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'contact' => 'nullable|string|max:255',
            'operational_hours' => 'nullable|string|max:255',
            'waste_types' => 'nullable|string',
            'logo' => 'nullable|image|max:2048',
        ]);

        $user = auth()->user();
        $bank = $user->bankProfile;

        if (!$bank) {
            $bank = new \App\Models\BankProfile();
            $bank->user_id = $user->id;
        }

        if ($request->hasFile('logo')) {
            if ($bank->logo) {
                Storage::disk('public')->delete($bank->logo);
            }
            $bank->logo = $request->file('logo')->store('logos', 'public');
        }

        $bank->fill($request->only([
            'name', 'description', 'location', 'contact',
            'operational_hours', 'waste_types'
        ]));

        $bank->save();

        return redirect()->route('bank.profile.show')->with('success', 'Profil berhasil diperbarui!');
    }



    public function dashboard()
    {
        // Cek role pengguna yang sedang login
        $user = Auth::user();
        dd($user->role); // Menampilkan role pengguna yang login
    }

}

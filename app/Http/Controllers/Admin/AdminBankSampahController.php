<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\BankProfile;

class AdminBankSampahController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'bank_sampah');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $banks = $query->paginate(10);

        return view('admin.bank-sampah.index', compact('banks'));
    }

    public function edit($id)
    {
        $bank = User::where('role', 'bank_sampah')->with('bankProfile')->findOrFail($id);
        return view('admin.bank-sampah.edit', compact('bank'));
    }

    public function update(Request $request, $id)
    {
        $user = User::where('role', 'bank_sampah')->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string',
            'location' => 'nullable|string',
            'status' => 'required|boolean',
            'image' => 'nullable|image|max:2048',
        ]);

        // Update user
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'status' => $request->status,
        ]);

        // Update atau buat profil
        $profile = BankProfile::firstOrNew(['user_id' => $user->id]);
        $profile->phone = $request->phone;
        $profile->location = $request->location;
        $profile->name = $user->name; // <- PENAMBAHAN PENTING

        // Handle upload gambar
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('bank_images', 'public');
            $profile->image = $imagePath;
        }

        $profile->save();

        return redirect()->route('admin.bank.bank-sampah.index')->with('success', 'Bank Sampah updated successfully.');
    }

    public function destroy($id)
    {
        $bank = User::where('role', 'bank_sampah')->findOrFail($id);
        $bank->delete();

        return redirect()->route('admin.bank.bank-sampah.index')->with('success', 'Bank Sampah deleted successfully.');
    }

    public function activate($id)
    {
        $bank = User::where('role', 'bank_sampah')->findOrFail($id);
        $bank->status = 1;
        $bank->save();

        return redirect()->back()->with('success', 'Bank Sampah activated successfully.');
    }

    public function deactivate($id)
    {
        $bank = User::where('role', 'bank_sampah')->findOrFail($id);
        $bank->status = 0;
        $bank->save();

        return redirect()->back()->with('success', 'Bank Sampah deactivated successfully.');
    }
}

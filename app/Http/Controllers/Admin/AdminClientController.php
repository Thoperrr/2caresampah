<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ClientProfile;

class AdminClientController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'client');
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%");
            });
        }
        if ($request->filled('status')) {
            $status = (int) $request->input('status');
            $query->where('status', $status);
        }
        $clients = $query->with('clientProfile')->paginate(10);
        $banks = User::where('role', 'bank_sampah')->with('bankProfile')->paginate(10);
        return view('admin.clients.index', compact('clients', 'banks'));
    }

    public function activate($id)
    {
        $user = User::where('role', 'client')->findOrFail($id);
        $user->status = true;
        $user->save();
        return redirect()->route('admin.clients.index')->with('success', 'Client activated successfully.');
    }

    public function deactivate($id)
    {
        $user = User::where('role', 'client')->findOrFail($id);
        $user->status = false;
        $user->save();
        return redirect()->route('admin.clients.index')->with('success', 'Client deactivated successfully.');
    }

    public function edit($id)
    {
        $user = User::where('role', 'client')->with('clientProfile')->findOrFail($id);
        return view('admin.clients.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::where('role', 'client')->findOrFail($id);
        $user->update($request->only(['name', 'email', 'status']));
        // Optionally update client profile fields here
        return redirect()->route('admin.clients.index')->with('success', 'Client updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::where('role', 'client')->findOrFail($id);
        $user->delete();
        return redirect()->route('admin.clients.index')->with('success', 'Client deleted successfully.');
    }
}
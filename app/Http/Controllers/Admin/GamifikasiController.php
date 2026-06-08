<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\WasteTransaction;

class GamifikasiController extends Controller
{
    public function index()
    {
        $month = request('month', now()->month);
        $year = request('year', now()->year);

        $users = User::where('role', 'client')
            ->orderByDesc('points_balance')
            ->get()
            ->map(function ($user) use ($month, $year) {
                $user->points = $user->points_balance ?? 0;
                $user->total_weight = WasteTransaction::where('user_id', $user->id)
                    ->whereMonth('collected_at', $month)
                    ->whereYear('collected_at', $year)
                    ->sum('weight');
                return $user;
            })
            ->values();

        return view('gamifikasi.index', compact('users'));
    }

    public function adminLeaderboard()
    {
        $users = User::where('role', 'client')
            ->orderByDesc('points_balance')
            ->get();

        return view('admin.leaderboard.index', compact('users'));
    }

    public function updatePoints(\Illuminate\Http\Request $request, User $user)
    {
        $request->validate([
            'points_balance' => 'required|integer|min:0',
        ]);
        $user->points_balance = $request->points_balance;
        $user->save();

        return redirect()->route('admin.leaderboard.index')->with('success', 'Poin user berhasil diupdate.');
    }
}
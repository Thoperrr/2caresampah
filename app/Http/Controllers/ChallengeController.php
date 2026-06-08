<?php

namespace App\Http\Controllers;

use App\Models\WasteTransaction;
use Illuminate\Http\Request;

class ChallengeController extends Controller
{
    public function index()
    {
        $month = now()->month;
        $year = now()->year;

        // Hitung total berat sampah user untuk bulan ini
        $totalWeight = WasteTransaction::where('user_id', auth()->id())
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->sum('weight');

        // Cek apakah challenge sudah tercapai (target 10kg)
        $isCompleted = $totalWeight >= 10;

        return view('gamifikasi.challenge', compact('totalWeight', 'isCompleted', 'month', 'year'));
    }
}
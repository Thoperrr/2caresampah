<?php

namespace App\Http\Controllers;

use App\Models\PointRedemption;
use App\Services\PointService;
use App\Models\Reward;
use Illuminate\Http\Request;

class PointRedemptionController extends Controller
{
    public function index()
    {
        $redemptions = auth()->user()->pointRedemptions()->latest()->get();
        $rewards = Reward::active()->get();
        return view('client.redempt.index', compact('redemptions', 'rewards'));
    }

    public function create()
    {
        $rewards = Reward::active()->get();
        return view('client.redempt.create', compact('rewards'));
    }

    public function store(Request $request, PointService $pointService)
    {

        $request->validate([
            'reward_id' => 'required|exists:rewards,id',
            'method' => 'required|in:bank,ewallet',
            'destination' => 'required|string|max:255'
        ]);

        $user = auth()->user();
        $reward = Reward::findOrFail($request->reward_id);
        $balance = $pointService->getBalance($user);

        if ($reward->points_required > $balance) {
            return back()->withErrors(['points' => 'Poin tidak cukup']);
        }

        PointRedemption::create([
            'user_id' => $user->id,
            'points' => $reward->points_required,
            'amount' => $reward->cash_value,
            'method' => $request->method,
            'destination' => $request->destination,
            'status' => 'pending'
        ]);

        // Kurangi poin user
        $pointService->spendPoints($user, $reward->points_required, 'Penukaran poin ke saldo');

        return redirect()->route('points.redemptions.index')
            ->with('success', 'Permintaan penukaran poin berhasil diajukan');
    }

    public function cancel($id, PointService $pointService)
    {
        $redempt = auth()->user()->pointRedemptions()->where('status', 'pending')->findOrFail($id);
        // Kembalikan poin user
        $pointService->awardPoints(auth()->user(), $redempt->points, 'Pembatalan penukaran poin');
        $redempt->status = 'cancelled';
        $redempt->save();

        return back()->with('success', 'Request penukaran berhasil dibatalkan.');
    }
}

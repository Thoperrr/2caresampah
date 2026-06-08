<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reward;
use Illuminate\Http\Request;

class RewardController extends Controller
{
    public function index()
    {
        $rewards = Reward::latest()->get();
        return view('admin.rewards.index', compact('rewards'));
    }

    public function create()
    {
        return view('admin.rewards.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'points_required' => 'required|integer|min:1',
            'cash_value' => 'required|numeric|min:0',
        ]);

        Reward::create($validated);

        return redirect()
            ->route('admin.rewards.index')
            ->with('success', 'Reward berhasil ditambahkan');
    }

    public function edit(Reward $reward)
    {
        return view('admin.rewards.edit', compact('reward'));
    }

    public function update(Request $request, Reward $reward)
    {
        $validated = $request->validate([
            'points_required' => 'required|integer|min:1',
            'cash_value' => 'required|numeric|min:0',
            'is_active' => 'boolean'
        ]);

        $reward->update($validated);

        return redirect()
            ->route('admin.rewards.index')
            ->with('success', 'Reward berhasil diperbarui');
    }

    public function destroy(Reward $reward)
    {
        $reward->delete();

        return redirect()
            ->route('admin.rewards.index')
            ->with('success', 'Reward berhasil dihapus');
    }
    public function toggleStatus(Reward $reward)
    {
        $reward->update([
            'is_active' => !$reward->is_active
        ]);

        return redirect()
            ->route('admin.rewards.index')
            ->with('success', 'Status reward berhasil diubah');
    }
}
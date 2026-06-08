<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PointRedemption;
use App\Services\PointService;
use Illuminate\Http\Request;

class PointRedemptionController extends Controller
{
    public function index()
    {
        $redemptions = PointRedemption::with('user')->latest()->get();
        return view('admin.redempt.index', compact('redemptions'));
    }

    public function approve($id, PointService $pointService)
    {
        $redempt = PointRedemption::findOrFail($id);
        if ($redempt->status !== 'pending') {
            return back()->withErrors(['msg' => 'Request sudah diproses.']);
        }
        $redempt->status = 'approved';
        $redempt->save();

        // (Opsional) Kirim notifikasi ke user di sini

        return back()->with('success', 'Request berhasil di-approve.');
    }

    public function reject($id)
    {
        $redempt = PointRedemption::findOrFail($id);
        if ($redempt->status !== 'pending') {
            return back()->withErrors(['msg' => 'Request sudah diproses.']);
        }
        $redempt->status = 'rejected';
        $redempt->save();

        // (Opsional) Kirim notifikasi ke user di sini

        return back()->with('success', 'Request berhasil di-reject.');
    }
}

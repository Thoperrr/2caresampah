<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\PickupRequest;


class BankDashboardController extends Controller
{
    public function index()
    {
        $bankSampahId = auth()->id(); // ID user bank sampah yang sedang login

        $pickupRequests = PickupRequest::with(['user', 'collector'])
            ->where('collector_id', $bankSampahId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('bank.dashboard', [
            'pickupRequests' => $pickupRequests,
        ]);
    }
    public function schedule(Request $request)
    {
        $request->validate([
            'pickup_request_id' => 'required|exists:pickup_requests,id',
            'tanggal' => 'required|date'
        ]);

        $scheduledAt = $request->tanggal;

        $pickup = PickupRequest::findOrFail($request->pickup_request_id);
        $pickup->pickup_date = $scheduledAt;
        $pickup->status = 'Assigned';
        $pickup->save();

        return redirect()->back()->with('success', 'Jadwal penjemputan berhasil diatur!');
    }
}
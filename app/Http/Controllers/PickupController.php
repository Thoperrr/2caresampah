<?php

namespace App\Http\Controllers;

use App\Models\PickupRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PickupController extends Controller
{
    public function index()
    {
        // Ambil semua permintaan penjemputan
        $pickupRequests = PickupRequest::all();

        // Ambil semua user dengan role bank_sampah
        $collectors = User::where('role', 'bank_sampah')->get();

        // Tampilkan halaman index dengan data permintaan penjemputan dan collector
        return view('penjemputan_sampah.index', [
            'pickupRequests' => $pickupRequests,
            'collectors' => $collectors,
        ]);
    }
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'alamat' => 'required|string',
            'collector_id' => 'required|exists:users,id',
        ]);

        // Ambil data jenis sampah & berat dari session
        $pickupWastes = session('pickup_wastes', []);

        // Validasi ketersediaan data sampah
        if (empty($pickupWastes)) {
            return redirect()
                ->route('exchange.index')
                ->with('error', 'Silakan pilih sampah yang akan dijemput terlebih dahulu melalui menu Penukaran Sampah.');
        }

        $jenisSampah = collect($pickupWastes)->pluck('name')->implode(', ');
        $totalBerat = collect($pickupWastes)->sum('weight');

        // Simpan data ke database
        $pickupRequest = PickupRequest::create([
            'user_id' => auth()->id(),
            'alamat' => $validated['alamat'],
            'jenis_sampah' => $jenisSampah,
            'berat' => $totalBerat,
            'collector_id' => $validated['collector_id'],
            'transaction_id' => 'TRX' . now()->format('YmdHis'),
            'status' => 'Pending',
        ]);

        // Hapus data pickup_wastes dari session setelah berhasil
        session()->forget('pickup_wastes');

        // Redirect ke halaman index penjemputan
        return redirect()
            ->route('penjemputan.index')
            ->with('success', 'Request berhasil dibuat!');
    }

    public function updateStatus(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'status' => 'required|in:Pending,Assigned,Completed,Cancelled', // Tambahkan 'Cancelled'
        ]);

        // Cari request berdasarkan ID
        $pickupRequest = PickupRequest::findOrFail($id);

        // Logika tambahan untuk pembatalan
        if ($validated['status'] === 'Cancelled' && $pickupRequest->status !== 'Pending') {
            return redirect()->route('penjemputan.index')->with('error', 'Hanya penjemputan dengan status Pending yang dapat dibatalkan.');
        }

        // Update status
        $pickupRequest->update(['status' => $validated['status']]);

        // Redirect ke halaman index penjemputan
        $message = $validated['status'] === 'Cancelled' ? 'Penjemputan berhasil dibatalkan.' : 'Status berhasil diperbarui!';
        return redirect()->route('penjemputan.index')->with('success', $message);
    }

    public function assignCollector(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'collector_id' => 'required|exists:users,id', // Validasi collector_id dari tabel users
        ]);

        // Cari request berdasarkan ID
        $pickupRequest = PickupRequest::findOrFail($id);

        // Pastikan user dengan ID tersebut memiliki role bank_sampah
        $collector = User::where('id', $validated['collector_id'])
            ->where('role', 'bank_sampah')
            ->firstOrFail();

        // Update collector_id
        $pickupRequest->update(['collector_id' => $collector->id, 'status' => 'Assigned']);

        // Redirect ke halaman index penjemputan
        return redirect()->route('penjemputan.index')->with('success', 'Collector berhasil ditugaskan!');
    }

    public function getRequestsByStatus(Request $request, $status)
    {
        // Validasi status
        if (!in_array($status, ['Pending', 'Assigned', 'Completed'])) {
            return response()->json(['message' => 'Status tidak valid!'], 400);
        }

        // Ambil semua request berdasarkan status
        $pickupRequests = PickupRequest::where('status', $status)->get();

        return view('penjemputan_sampah.index', [
            'pickupRequests' => $pickupRequests,
            'status' => $status,
        ]);
    }
}
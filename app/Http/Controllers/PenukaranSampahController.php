<?php

namespace App\Http\Controllers;

use App\Models\Point;
use App\Models\Waste;
use App\Services\PointService;
use Illuminate\Http\Request;

class PenukaranSampahController extends Controller
{
    protected $pointService;

    public function __construct(PointService $pointService)
    {
        $this->pointService = $pointService;
    }

    public function history()
    {
        $points = auth()->user()->points()->latest()->paginate(10);
        return view('points.history', compact('points'));
    }

    public function depositForm()
    {
        $activeWastes = Waste::active()->get();
        return view('points.deposit', compact('activeWastes'));
    }

    public function processDeposit(Request $request)
    {
        $validated = $request->validate([
            'waste_id' => 'required|exists:wastes,id',
            'weight' => 'required|numeric|min:0.1'
        ]);

        $waste = Waste::findOrFail($validated['waste_id']);
        $weight = $validated['weight'];

        $points = $waste->points_per_kg * $weight;

        $this->pointService->awardPoints(
            auth()->user(),
            $points,
            "Setor sampah {$waste->name} seberat {$weight}kg"
        );

        return response()->json([
            'message' => 'Poin berhasil ditambahkan',
            'points_earned' => $points,
            'new_balance' => $this->pointService->getBalance(auth()->user())
        ]);
    }

    public function processExchange(Request $request)
    {
        $validated = $request->validate([
            'waste_id' => 'required|array|min:1',
            'waste_id.*' => 'required|exists:wastes,id',
            'weight' => 'required|array|min:1',
            'weight.*' => 'required|numeric|min:0.1',
            'pickup_option' => 'required|in:antar,jemput',
        ]);

        $wasteIds = $validated['waste_id'];
        $weights = $validated['weight'];
        $pickupOption = $validated['pickup_option'];
        $userId = auth()->id();

        $wasteData = [];
        foreach ($wasteIds as $i => $wasteId) {
            $weight = $weights[$i];
            $waste = \App\Models\Waste::find($wasteId);
            $points = $waste ? $waste->points_per_kg * $weight : 0;

            // Simpan transaksi penukaran ke tabel WasteTransaction
            \App\Models\WasteTransaction::create([
                'user_id' => $userId,
                'waste_id' => $wasteId,
                'weight' => $weight,
                'pickup_option' => $pickupOption,
            ]);

            // Simpan transaksi penukaran ke tabel Point
            \App\Models\Point::create([
                'user_id' => $userId,
                'amount' => $points,
                'type' => 'earn',
                'description' => "Penukaran sampah {$waste->name} seberat {$weight}kg"
            ]);

            $wasteData[] = [
                'name' => $waste->name,
                'weight' => $weight,
            ];
        }

        if ($pickupOption === 'jemput') {
            // Simpan data ke session untuk diteruskan ke halaman penjemputan
            session([
                'pickup_wastes' => $wasteData
            ]);
            return redirect()->route('penjemputan.index');
        }

        return redirect()->route('exchange.index')->with('success', "Berhasil menukar sampah dan mendapatkan poin!");
    }

    public function getBalance()
    {
        $balance = $this->pointService->getBalance(auth()->user());
        return response()->json(['balance' => $balance]);
    }

    public function index()
    {
        $wasteTypes = \App\Models\Waste::all();
        $banks = \App\Models\User::role('bank_sampah')->get();
        return view('penukaran_sampah.index', compact('wasteTypes', 'banks'));
    }

    public function notifications()
    {
        $notifications = auth()->user()->notifications()->latest()->paginate(10);
        return view('notifications.index', compact('notifications'));
    }
}
<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WasteTransaction;
use Illuminate\Http\Request;

class PenukaranSampahAdminController extends Controller
{
    public function index()
    {
        // Group transaksi berdasarkan user, pickup_option, dan created_at (tanggal & jam)
        $grouped = \App\Models\WasteTransaction::with(['user', 'waste'])
            ->orderByDesc('created_at')
            ->get()
            ->groupBy(function($trx) {
                // Group by user, pickup_option, dan waktu (menit)
                return $trx->user_id . '|' . $trx->pickup_option . '|' . $trx->created_at->format('Y-m-d H:i');
            });
        $transactions = $grouped->map(function($items) {
            $first = $items->first();
            return [
                'user' => $first->user,
                'pickup_option' => $first->pickup_option,
                'created_at' => $first->created_at,
                'wastes' => $items->map(function($trx) {
                    return [
                        'name' => $trx->waste->name ?? '-',
                        'weight' => $trx->weight
                    ];
                })
            ];
        });
        return view('admin.penukaran_sampah.index', ['transactions' => $transactions]);
    }
}

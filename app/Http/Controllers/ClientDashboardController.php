<?php

namespace App\Http\Controllers;

use App\Services\PointService;

class ClientDashboardController extends Controller
{
    protected $pointService;

    public function __construct(PointService $pointService)
    {
        $this->pointService = $pointService;
    }

    public function index()
    {
        $user = auth()->user();
        $balance = $this->pointService->getBalance($user);
        $transactions = $this->pointService->getTransactionHistory($user, 5);

        // Calculate total waste deposited
        $totalWaste = 0;
        $latestTransaction = null;

        foreach ($transactions as $transaction) {
            if ($transaction->isEarning()) {
                // Extract weight from description (assuming format "Deposited Xkg of Y")
                if (preg_match('/Deposited ([\d.]+)kg/', $transaction->description, $matches)) {
                    $totalWaste += floatval($matches[1]);
                }
            }
            if (!$latestTransaction) {
                $latestTransaction = $transaction;
            }
        }

        return view('client.dashboard', [
            'balance' => $balance,
            'totalWaste' => $totalWaste,
            'lastTransaction' => $latestTransaction ? $latestTransaction->created_at->format('d M') : '-',
            'transactions' => $transactions
        ]);
    }
}
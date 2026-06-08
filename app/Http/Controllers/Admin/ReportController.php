<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Point;
use App\Models\Reward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function pointsReport()
    {
        // Total points issued (earned)
        $totalPointsIssued = Point::where('type', 'earn')->sum('amount');

        // Total points spent (redeemed)
        $totalPointsSpent = Point::where('type', 'spend')->sum('amount');

        // Total rewards redeemed count
        // $totalRewardsRedeemed = Reward::withCount('redemptions')->get();

        return view('admin.reports.points', compact('totalPointsIssued', 'totalPointsSpent'));
    }
}

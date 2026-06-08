<?php

namespace App\Http\Controllers;
use App\Models\Point;

use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Total points issued (earned)
        $totalPointsIssued = Point::where('type', 'earn')->sum('amount');

        // Total points spent (redeemed)
        $totalPointsSpent = Point::where('type', 'spend')->sum('amount');
        return view('admin.dashboard', compact('totalPointsIssued', 'totalPointsSpent'));
    }
}
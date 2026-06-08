<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PickupRequest;
use App\Models\User;

class PickupRequestAdminController extends Controller
{
    public function index()
    {
        $requests = PickupRequest::with('user')->orderBy('created_at', 'desc')->get();
        $availablePetugas = User::where('role', 'bank_sampah')->get();

        return view('admin.Penjemputan_sampahadmin.pickup_schedule', [
            'requests' => $requests,
            'availablePetugas' => $availablePetugas,
        ]);

    }
}
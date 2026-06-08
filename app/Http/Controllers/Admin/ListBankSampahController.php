<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class ListBankSampahController extends Controller
{
    public function index()
    {
        $bankAccounts = \App\Models\User::where('role', 'bank_sampah')->with('bankProfile')->get();
        return view('admin.list-bank.index', compact('bankAccounts'));
    }
}

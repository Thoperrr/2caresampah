<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\PointService;
use Illuminate\Http\Request;

class PointManagementController extends Controller
{
    protected $pointService;

    public function __construct(PointService $pointService)
    {
        $this->pointService = $pointService;
    }

    public function index()
    {
        $users = User::with(['points' => function ($query) {
            $query->latest();
        }])->get();

        return view('admin.points.index', compact('users'));
    }

    public function addPoints(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'points' => 'required|integer|min:1',
            'description' => 'required|string|max:255'
        ]);

        $user = User::findOrFail($request->user_id);

        $this->pointService->awardPoints(
            $user,
            $request->points,
            $request->description
        );

        return redirect()->route('admin.points.manage')
            ->with('success', 'Poin berhasil ditambahkan ke pengguna');
    }
}

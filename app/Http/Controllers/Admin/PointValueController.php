<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Waste;
use Illuminate\Http\Request;

class PointValueController extends Controller
{
    public function index()
    {
        $wasteTypes = Waste::all();
        return view('admin.points.values.index', compact('wasteTypes'));
    }

    public function create()
    {
        return view('admin.points.values.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:wastes',
            'points_per_kg' => 'required|numeric|min:0',
            'description' => 'nullable|string'
        ], [
            'name.required' => 'Please fill out this field.',
            'name.unique' => 'The name has already been taken',
            'points_per_kg.min' => 'Value must be greater than or equal to 0',
            'points_per_kg.required' => 'Please fill out this field.'
        ]);

        Waste::create($validated);

        return redirect()
            ->route('admin.points.values')
            ->with('success', 'Jenis sampah berhasil ditambahkan');
    }

    public function edit(Waste $waste)
    {
        return view('admin.points.values.edit', compact('waste'));
    }

    public function update(Request $request, Waste $waste)
    {
        $validated = $request->validate([
            'points_per_kg' => 'required|integer|min:0',
            'description' => 'nullable|string'
        ]);

        $waste->update($validated);

        return redirect()
            ->route('admin.points.values')
            ->with('success', 'Nilai poin berhasil diperbarui');
    }

    public function destroy(Waste $waste)
    {
        $waste->delete();

        return redirect()
            ->route('admin.points.values')
            ->with('success', 'Jenis sampah berhasil dihapus');
    }
}

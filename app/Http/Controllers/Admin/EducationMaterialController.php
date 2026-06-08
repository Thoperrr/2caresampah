<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EducationMaterial;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;

class EducationMaterialController extends Controller
{
    public function index()
    {
        $materials = \App\Models\EducationMaterial::all();
        return view('admin.edukasi.index', compact('materials'));
    }

    public function create()
    {
        return view('admin.edukasi.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'type' => 'required|in:article,video',
                'content' => $request->type === 'article' ? 'required|string' : 'nullable',
                'url' => $request->type === 'video' ? 'nullable|url' : 'nullable',
                'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4000',
            ]);

            $data = [
                'title' => $validated['title'],
                'type' => $validated['type'],
                'content' => $request->input('content'),
                'url' => $request->input('url'),
                'is_featured' => false,
            ];

            if ($request->hasFile('thumbnail')) {
                $path = $request->file('thumbnail')->store('thumbnails', 'public');
                $data['thumbnail'] = $path;
            }

            EducationMaterial::create($data);
            return redirect()->route('edukasi.index')->with('success', 'Materi berhasil ditambahkan.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan materi. Silakan coba lagi.'])->withInput();
        }
    }

    public function edit(EducationMaterial $educationMaterial)
    {
        return view('admin.edukasi.edit', compact('educationMaterial'));
    }

    public function update(Request $request, EducationMaterial $educationMaterial)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'type' => 'required|in:article,video',
                'content' => $request->type === 'article' ? 'required|string' : 'nullable',
                'url' => $request->type === 'video' ? 'nullable|url' : 'nullable',
                'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $data = [
                'title' => $validated['title'],
                'type' => $validated['type'],
                'content' => $request->input('content'),
                'url' => $request->input('url'),
            ];

            if ($request->hasFile('thumbnail')) {
                if ($educationMaterial->thumbnail && Storage::disk('public')->exists($educationMaterial->thumbnail)) {
                    Storage::disk('public')->delete($educationMaterial->thumbnail);
                }
                $path = $request->file('thumbnail')->store('thumbnails', 'public');
                $data['thumbnail'] = $path;
            }

            $educationMaterial->update($data);
            return redirect()->route('edukasi.index')->with('success', 'Materi berhasil diperbarui.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan saat memperbarui materi. Silakan coba lagi.'])->withInput();
        }
    }

    public function destroy(EducationMaterial $educationMaterial)
    {
        try {
            if ($educationMaterial->thumbnail && Storage::disk('public')->exists($educationMaterial->thumbnail)) {
                Storage::disk('public')->delete($educationMaterial->thumbnail);
            }
            $educationMaterial->forceDelete();
            return redirect()->route('edukasi.index')->with('success', 'Materi berhasil dihapus secara permanen.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan saat menghapus materi.'])->withInput();
        }
    }

    public function toggleFeatured(EducationMaterial $educationMaterial)
    {
        try {
            $educationMaterial->update(['is_featured' => !$educationMaterial->is_featured]);
            return back()->with('success', 'Status materi utama telah diubah.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal mengubah status materi utama.']);
        }
    }
}

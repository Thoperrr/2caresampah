<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EducationMaterial;

class EdukasiController extends Controller
{
    public function index()
    {
        // Ambil semua materi
        $featuredMaterials = EducationMaterial::where('is_featured', true)->get();
        $articles = EducationMaterial::where('type', 'article')->where('is_featured', false)->get();
        $videos = EducationMaterial::where('type', 'video')->get();

        return view('edukasi.index', compact('featuredMaterials', 'articles', 'videos'));
    }
}
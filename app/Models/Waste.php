<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Waste extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'points_per_kg',
        'description',
        'is_active'
    ];

    protected $casts = [
        'points_per_kg' => 'integer',
        'is_active' => 'boolean'
    ];

    // Scope untuk waste yang aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Relasi dengan transaksi sampah (jika diperlukan nanti)
    public function transactions()
    {
        return $this->hasMany(WasteTransaction::class);
    }
}
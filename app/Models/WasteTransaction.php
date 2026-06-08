<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WasteTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'waste_id',      // jenis sampah, relasi ke tabel wastes
        'weight',        // berat dalam kg
        'pickup_option', // added for sidebar and transaction
        'description',   // opsional, keterangan transaksi
        'collected_at',  // tanggal penyerahan (opsional, default ke created_at)
    ];

    protected $casts = [
        'weight' => 'float',
        'collected_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function waste()
    {
        return $this->belongsTo(Waste::class);
    }
}
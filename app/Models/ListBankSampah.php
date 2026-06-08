<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ListBankSampah extends Model
{
    protected $fillable = [
        'nama', 'lokasi', 'kontak', 'jam_operasional', 'jenis_sampah', 'gambar'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PickupRequest extends Model
{
    protected $fillable = [
        'user_id',
        'alamat',
        'jenis_sampah',
        'berat',
        'transaction_id',
        'status',
        'collector_id',
        'pickup_date',
    ];

    protected $casts = [
        'status' => 'string',
        'weight' => 'float',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function collector()
    {
        return $this->belongsTo(User::class, 'collector_id');
    }
}
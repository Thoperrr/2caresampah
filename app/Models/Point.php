<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Point extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'amount',
        'type',
        'description'
    ];

    protected $casts = [
        'amount' => 'integer',
        'created_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scope for earning points
    public function scopeEarned($query)
    {
        return $query->where('type', 'earn');
    }

    // Scope for spent points
    public function scopeSpent($query)
    {
        return $query->where('type', 'spend');
    }

    // Get total points earned
    public function getTotalEarnedAttribute()
    {
        return $this->where('user_id', $this->user_id)
            ->where('type', 'earn')
            ->sum('amount');
    }

    // Get total points spent
    public function getTotalSpentAttribute()
    {
        return $this->where('user_id', $this->user_id)
            ->where('type', 'spend')
            ->sum('amount');
    }

    // Get current balance
    public function getCurrentBalanceAttribute()
    {
        return $this->total_earned - $this->total_spent;
    }

    // Check if transaction is earning points
    public function isEarning()
    {
        return $this->type === 'earn';
    }

    // Check if transaction is spending points
    public function isSpending()
    {
        return $this->type === 'spend';
    }
}
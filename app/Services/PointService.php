<?php

namespace App\Services;

use App\Models\Point;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Exception;

class PointService
{
    /**
     * Award points to a user
     *
     * @param User $user
     * @param int $amount
     * @param string $description
     * @return Point
     */
    public function awardPoints(User $user, int $amount, string $description): Point
    {
        $point = Point::create([
            'user_id' => $user->id,
            'amount' => $amount,
            'type' => 'earn',
            'description' => $description
        ]);
        $user->increment('points_balance', $amount);
        return $point;
    }

    /**
     * Spend points from user's balance
     *
     * @param User $user
     * @param int $amount
     * @param string $description
     * @return Point
     * @throws Exception
     */
    public function spendPoints(User $user, int $amount, string $description): Point
    {
        DB::beginTransaction();
        try {
            $currentBalance = $user->points_balance;

            if ($currentBalance < $amount) {
                throw new Exception('Insufficient points balance');
            }

            $point = Point::create([
                'user_id' => $user->id,
                'amount' => $amount,
                'type' => 'spend',
                'description' => $description
            ]);
            $user->decrement('points_balance', $amount);

            DB::commit();
            return $point;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Get user's current point balance
     *
     * @param User $user
     * @return int
     */
    public function getBalance(User $user): int
    {
        return $user->points_balance;
    }

    /**
     * Get user's point transaction history
     *
     * @param User $user
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getTransactionHistory(User $user, int $limit = 10)
    {
        return Point::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take($limit)
            ->get();
    }

    /**
     * Calculate points based on waste weight
     *
     * @param float $weight Weight in kilograms
     * @param string $wasteType Type of waste
     * @return int
     */
    public function calculatePointsFromWaste(float $weight, string $wasteType): int
    {
        $pointsPerKg = [
            'plastic' => 10,
            'paper' => 5,
            'metal' => 15,
            'glass' => 8,
            'organic' => 3
        ];

        $rate = $pointsPerKg[strtolower($wasteType)] ?? 5;
        return (int) ($weight * $rate);
    }
}
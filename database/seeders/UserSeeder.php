<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Point;
use App\Services\PointService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    protected $pointService;

    public function __construct(PointService $pointService)
    {
        $this->pointService = $pointService;
    }

    public function run()
    {
        // Create roles if they don't exist
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $bankRole = Role::firstOrCreate(['name' => 'bank_sampah']);
        $clientRole = Role::firstOrCreate(['name' => 'client']);

        // Create Admin Users
        $adminUsers = [
            User::firstOrCreate(
                ['email' => 'admin1@example.com'],
                [
                    'name' => 'Admin One',
                    'password' => Hash::make('admin123'),
                    'role' => 'admin'
                ]
            )->assignRole('admin'),

            User::firstOrCreate(
                ['email' => 'admin2@example.com'],
                [
                    'name' => 'Admin Two',
                    'password' => Hash::make('admin123'),
                    'role' => 'admin'
                ]
            )->assignRole('admin')
        ];

        // Set points for admin users (1,000,000 - 1,500,000)
        foreach ($adminUsers as $admin) {
            $this->pointService->awardPoints(
                $admin,
                rand(1000000, 1500000),
                'Initial admin points'
            );
        }

        // Create Bank Sampah Users
        $bankUsers = [];
        for ($i = 1; $i <= 5; $i++) {
            $bankUsers[] = User::firstOrCreate(
                ['email' => "bank{$i}@example.com"],
                [
                    'name' => "Bank Sampah {$i}",
                    'password' => Hash::make('bank123'),
                    'role' => 'bank_sampah'
                ]
            )->assignRole('bank_sampah');
        }

        // Set points for bank users (100,000 - 500,000)
        foreach ($bankUsers as $bank) {
            $this->pointService->awardPoints(
                $bank,
                rand(100000, 500000),
                'Initial bank points'
            );
        }

        // Create Client Users
        $clientUsers = [];
        for ($i = 1; $i <= 10; $i++) {
            $clientUsers[] = User::firstOrCreate(
                ['email' => "client{$i}@example.com"],
                [
                    'name' => "Client User {$i}",
                    'password' => Hash::make('client123'),
                    'role' => 'client'
                ]
            )->assignRole('client');
        }

        // Set points for client users (10,000 - 100,000)
        foreach ($clientUsers as $client) {
            $this->pointService->awardPoints(
                $client,
                rand(10000, 100000),
                'Initial client points'
            );
        }
    }
}
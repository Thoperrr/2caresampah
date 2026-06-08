<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Create or get roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $bankRole = Role::firstOrCreate(['name' => 'bank_sampah']);
        $clientRole = Role::firstOrCreate(['name' => 'client']);

        // Create admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@2caresampah.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin123'),
            ]
        );
        $admin->assignRole($adminRole);

        // Create bank sampah user
        $bankSampah = User::firstOrCreate(
            ['email' => 'bank@2caresampah.com'],
            [
                'name' => 'Bank Sampah',
                'password' => Hash::make('bank123'),
            ]
        );
        $bankSampah->assignRole($bankRole);

        // Create client user
        $client = User::firstOrCreate(
            ['email' => 'client@2caresampah.com'],
            [
                'name' => 'Client',
                'password' => Hash::make('client123'),
            ]
        );
        $client->assignRole($clientRole);
    }
}

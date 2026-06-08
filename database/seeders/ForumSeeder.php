<?php

namespace Database\Seeders;

use App\Models\Forum;
use App\Models\User;
use Illuminate\Database\Seeder;

class ForumSeeder extends Seeder
{
    public function run()
    {
        $users = User::where('role', 'client')->get();

        foreach ($users as $user) {
            Forum::create([
                'user_id' => $user->id,
                'title' => 'Pengalaman ' . $user->name . ' dalam Mengelola Sampah',
                'body' => 'Saya ingin berbagi pengalaman dalam mengelola sampah di rumah...'
            ]);
        }
    }
}
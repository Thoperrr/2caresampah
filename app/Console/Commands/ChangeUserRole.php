<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class ChangeUserRole extends Command
{
    protected $signature = 'user:change-role {user_id} {role}';
    protected $description = 'Change user role';

    public function handle()
    {
        $user = User::find($this->argument('user_id'));
        if (!$user) {
            $this->error('User not found!');
            return;
        }

        $user->syncRoles([$this->argument('role')]);
        $this->info('Role changed successfully!');
    }
}
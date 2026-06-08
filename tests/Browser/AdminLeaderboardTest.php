<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AdminLeaderboardTest extends DuskTestCase
{
    /**
     * Test admin can see leaderboard page.
     */
    public function testAdminLeaderboard(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://127.0.0.1:8000/admin/leaderboard')
                    ->type('email', 'admin@2caresampah.com')
                    ->type('password', 'admin123')
                    ->press('Login')
                    ->visit('/admin/leaderboard')
                    ->assertSee('Leaderboard User (Admin)')
                    ->type('points_balance', '100')
                    ->press('Update');
            $browser->screenshot('before-assert');
        });
    }
}

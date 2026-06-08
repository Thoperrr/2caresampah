<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class GamifikasiTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://127.0.0.1:8000/gamifikasi')
                    ->type('email', 'admin@2caresampah.com')
                    ->type('password', 'admin123')
                    ->press('Login')
                    ->visit('/gamifikasi')
                    ->select('month', '4')
                    ->press('Filter')
                    ->assertSee('Leaderboard');
            $browser->screenshot('before-assert');
        });
    }
}

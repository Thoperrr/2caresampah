<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class Dashboard03Test extends DuskTestCase
{
    /**
     * A Dusk test example.
     *  @group Dashboard03Test
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            try {
                $browser->visit('/')
                    ->ClickLink('Login')
                    ->type('email', 'bank@2caresampah.com')
                    ->type('password', 'bank123')
                    ->press('Login')
                    ->assertPathIs('/bank/dashboard')
                    ->screenshot('dashboard03_test_screenshot');
            } catch (\Exception $e) {
                $browser->screenshot('dashboard03_test_screenshot_error');
                throw $e;
            }
        });
    }
}

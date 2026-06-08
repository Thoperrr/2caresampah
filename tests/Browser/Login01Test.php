<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class Login01Test extends DuskTestCase
{
    /**
     * A Dusk test example.
     * @group Login01Test
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            try {
                $browser->visit('/')
                    ->ClickLink('Login')
                    ->type('email', 'bank2caresampah.com')
                    ->type('password', 'bank123')
                    ->press('Login')
                    ->assertPathIs('/bank/dashboard')
                    ->screenshot('login01_test_screenshot');
            } catch (\Exception $e) {
                $browser->screenshot('login01_test_screenshot_error');
                throw $e;
            }
        });
    }
}

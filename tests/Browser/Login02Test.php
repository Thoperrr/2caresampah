<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class Login02Test extends DuskTestCase
{
    /**
     * A Dusk test example.
     * @group Login02Test
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            try {
                $browser->visit('/')
                    ->ClickLink('Login')
                    ->type('email', 'client@2caresampah.com')
                    ->type('password', 'client123')
                    ->press('Login')
                    ->assertPathIs('/dashboard')
                    ->screenshot('login02_test_screenshot');
            } catch (\Exception $e) {
                $browser->screenshot('login02_test_screenshot_error');
                throw $e;
            }
        });
    }
}

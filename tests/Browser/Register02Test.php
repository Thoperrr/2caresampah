<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class Register02Test extends DuskTestCase
{
    /**
     * A Dusk test example.
     * @group Register02Test
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            try {
                $browser->visit('/')
                    ->ClickLink('Login')
                    ->clickLink('Tidak punya akun? Daftar')
                    ->type('name', 'client2')
                    ->type('email', 'client2@2caresampah.com')
                    ->type('password', 'client123')
                    ->type('password_confirmation', 'client123')
                    ->press('Sign up')
                    ->assertPathIs('/dashboard')
                    ->screenshot('register02_test_screenshot');
            } catch (\Exception $e) {
                $browser->screenshot('register02_test_screenshot_error');
                throw $e;
            }
        });
    }
}

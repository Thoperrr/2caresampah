<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class Logout01Test extends DuskTestCase
{
    /**
     * A Dusk test example.
     * @group Logout01Test
    /**
     * Test logout functionality for different user types
     */
    public function testLogout(): void
    {
        $this->browse(function (Browser $browser) {
            // Test logout for bank user
            $browser->visit('/')
                ->clickLink('Login')
                ->type('email', 'bank@2caresampah.com')
                ->type('password', 'bank123')
                ->press('Login')
                ->assertPathIs('/bank/dashboard')
                ->waitFor('#profile-dropdown')
                ->click('#profile-dropdown')
                ->waitFor('form[action="' . route('logout') . '"]')
                ->press('Logout')
                ->assertPathIs('/login');

            $browser->screenshot('logout_test_completed');
        });
    }
}
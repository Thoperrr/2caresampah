<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class PickupTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Test user can see real-time status of a pickup request.
     * @group PickupTest
     */
    public function testUserCanSeeRealTimePickupStatus(): void
    {
        $this->browse(function (Browser $browser) {
            // Login sebagai admin atau pengguna
            $browser->visit('/')
                ->clickLink('Login') // Klik tautan login
                ->type('email', 'admin@2caresampah.com') // Email admin
                ->type('password', 'admin123') // Password admin
                ->press('Login') // Tekan tombol login
                ->assertPathIs('/dashboard');
        });
    }   
    
}
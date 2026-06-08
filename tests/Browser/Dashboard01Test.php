<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class Dashboard01Test extends DuskTestCase
{
    /**
     * A basic browser test example.
     * @group Dashboard01Test
     */
    public function testBasicExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->ClickLink('Login')
                ->type('email', 'client@2caresampah.com')
                ->type('password', 'client123')
                ->press('Login')
                ->assertPathIs('/dashboard');
        });
    }
}

<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use function Laravel\Prompts\pause;

class Dashboard02Test extends DuskTestCase
{
    /**
     * A Dusk test example.
     * @group Dashboard02Test
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->ClickLink('Login')
                ->type('email', 'client@2caresampah.com')
                ->type('password', 'client123')
                ->press('Login')
                ->assertPathIs('/dashboard')
                ->pause(100)
                ->assertSee('Notifications');
        });
    }
}

<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DeleteForumTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     * @group DeleteForumTest
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            // Login sebagai admin
            $browser->visit('/')
                ->clickLink('Login')
                ->type('email', 'admin@2caresampah.com')
                ->type('password', 'admin123')
                ->press('Login')
                ->assertPathIs('/admin/dashboard');

            // Akses halaman forum
            $browser->visit('/forum')
                ->assertSee('Forum');
        });
    }
}

<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CreateForumTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     * @group CreateForumTest
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
                ->assertSee('Forum')
                ->assertSee('Create New Thread')
                ->clickLink('Create New Thread')
                ->assertPathIs('/forum/create')
                ->type('title', 'Test Forum Title')
                ->type('body', 'This is a test forum body.')
                ->press('Create Thread');
        });
    }
}

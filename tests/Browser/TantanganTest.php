<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TantanganTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testTantangan(): void
    {
       $this->browse(function (Browser $browser) {
            $browser->visit('http://127.0.0.1:8000/challenge')
                    ->type('email', 'client@2caresampah.com')
                    ->type('password', 'client123')
                    ->press('Login')
                    ->visit('/challenge')
                    ->assertSee('Tantangan Bulanan');
            $browser->screenshot('before-assert');
        });
    }
}

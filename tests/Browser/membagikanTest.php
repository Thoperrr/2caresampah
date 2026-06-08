<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class membagikanTest extends DuskTestCase
{
    /**
     * Test fitur membagikan artikel ke media sosial.
     * @group testmembagikan
     */
    public function testmembagikan(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/edukasi') // Akses halaman edukasi
                    ->clickLink('Instagram') // Klik link Instagram untuk membagikan
                    ->pause(2000) // Tunggu halaman Instagram terbuka
                    ->assertUrlIs('https://www.instagram.com/thoperrrrr'); // Verifikasi URL Instagram
        });
    }

}
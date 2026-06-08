<?php

namespace Tests\Browser;

use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class edukasiTest extends DuskTestCase
{
    /**
     * Test melihat daftar artikel dan video edukasi.
     * @group testmelihatfituredukasi
     */
    public function testmelihatfituredukasi(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1)) // Login sebagai pengguna dengan ID 1
                    ->visit('/edukasi') // Akses halaman edukasi
                    ->assertPathIs('/edukasi');
                    
        });
    }
}
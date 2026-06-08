<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ProfileClientTest extends DuskTestCase
{
    /** @test */
    public function user_can_login_and_view_profile_client_page()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://127.0.0.1:8000/') // ganti dengan URL lokal kamu kalau berbeda
                    ->clickLink('Login') // sesuaikan jika tombol login bukan link biasa
                    ->type('email', 'client@2caresampah.com')
                    ->type('password', 'client123')
                    ->press('Login')
                    ->pause(1000) // beri waktu setelah login

                    // klik ikon profil di pojok kanan atas
                    ->click('Ahmad Alifi') // pastikan tombol punya `@dusk` attribute
                    ->pause(500)

                    // klik tombol 'Profile Client' di dropdown
                    ->clickLink('Profil Client')
                    ->assertPathIs('/profile/edit'); // sesuaikan dengan URL
        
        });
    }
}

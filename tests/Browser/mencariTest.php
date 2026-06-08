<?php

namespace Tests\Browser;

use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class mencariTest extends DuskTestCase
{
    /**
     * Test fitur pencarian materi berdasarkan kata kunci.
     * @group testmencarimateri
     */
    public function testmencarimateri(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1)) // Login sebagai pengguna dengan ID 1
                    ->visit('/edukasi') // Akses halaman edukasi
                    ->assertPathIs('/edukasi') // Pastikan berada di halaman edukasi
                    ->assertVisible('#searchInput') // Pastikan input pencarian terlihat
                    ->type('#searchInput', 'Minyak') // Ketik kata kunci "Minyak"
                    ->press('Cari') // Klik tombol pencarian
                    ->assertSee('Minyak Jelantah Bisa Jadi Cuan!') // Verifikasi hasil pencarian
                    ->assertDontSee('Bank Sampah: Menabung Sampah, Menuai Manfaat'); // Pastikan hasil lain tidak muncul
        });
    }
}
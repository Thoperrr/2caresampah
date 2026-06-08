<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class Poin03Test extends DuskTestCase
{
    /**
     * Test admin can delete waste type points
     * @group Poin03Test
     */
    public function testDeleteWasteTypePoints(): void
    {
        $this->browse(function (Browser $browser) {
            // Login as admin and navigate to points management
            $browser->visit('/login')
                ->type('email', 'admin@2caresampah.com')
                ->type('password', 'admin123')
                ->press('Login')
                ->waitForLocation('/admin/dashboard') // Wait for redirect
                ->assertPathIs('/admin/dashboard')
                ->clickLink('Point Values')
                ->waitForLocation('/admin/points/values')
                ->assertPathIs('/admin/points/values')

                // Ensure table is loaded and contains data
                ->waitFor('#points-table') // Wait for table to load
                ->assertPresent('#waste-row-1') // Ensure first row exists

                // Get first waste type name
                ->tap(function (Browser $browser) {
                    $wasteName = $browser->text('#waste-name-1');
                    $browser->script("window.wasteName = `${wasteName}`");
                })

                // Click delete and handle modal
                ->click('#delete-waste-1')
                ->waitFor('#deleteModal.flex')

                // Confirm deletion
                ->within('#deleteModal', function ($modal) {
                    $modal->assertSee('Confirm Delete')
                        ->click('#confirm-delete');
                })

                // Wait for success message and verify
                ->waitFor('.bg-green-100')
                ->assertSee('Jenis sampah berhasil dihapus')
                ->assertScript('return !document.body.textContent.includes(window.wasteName)')
                ->screenshot('delete_points_test_completed');
        });
    }
}

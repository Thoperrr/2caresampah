<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\WasteType;

class Poin02Test extends DuskTestCase
{
    /**
     * Test admin can edit waste type points
     * @group Poin02Test
     */
    public function testEditWasteTypePoints(): void
    {
        $this->browse(function (Browser $browser) {
            // Login as admin and navigate to points management
            $browser->visit('/')
                ->clickLink('Login')
                ->type('email', 'admin@2caresampah.com')
                ->type('password', 'admin123')
                ->press('Login')
                ->assertPathIs('/admin/dashboard')
                ->clickLink('Point Values')
                ->assertPathIs('/admin/points/values')

                // Find and click edit link in table
                ->waitFor('.min-w-full') // Wait for table with specific class
                ->waitFor('.text-indigo-600') // Wait for edit link to be visible
                ->click('.text-indigo-600') // Click edit link
                ->assertUrlIs(route('admin.points.values.edit', ['waste' => 1]))

                // Edit the form values
                ->waitFor('#points_per_kg')
                ->clear('#points_per_kg')
                ->type('#points_per_kg', '10')
                ->clear('#description')
                ->type('#description', 'Updated description for waste type')
                ->press('Update Point Value')

                // Verify the update was successful using named route
                ->waitForLocation(route('admin.points.values'))
                ->waitFor('.bg-green-100') // Wait for success message container
                ->assertSee('Nilai poin berhasil diperbarui')
                ->assertSee('10')
                ->screenshot('edit_points_test_completed');
        });
    }
}

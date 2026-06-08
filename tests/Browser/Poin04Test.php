<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class Poin04Test extends DuskTestCase
{
    /**
     * Test adding waste type with negative points
     * @group Poin04Test
     */
    public function testAddWasteTypeWithNegativePoints(): void
    {
        $this->browse(function (Browser $browser) {
            // Login as admin
            $browser->visit('/login')
                ->type('email', 'admin@2caresampah.com')
                ->type('password', 'admin123')
                ->press('Login')
                ->waitForLocation('/admin/dashboard')
                ->assertPathIs('/admin/dashboard')

                // Navigate to points management
                ->clickLink('Point Values')
                ->waitForLocation('/admin/points/values')
                ->assertPathIs('/admin/points/values')

                // Navigate to create form and fill with negative points
                ->clickLink('Add New Waste Type')
                ->waitForLocation('/admin/points/values/create')
                ->assertPathIs('/admin/points/values/create')
                ->type('name', 'Plastic Bottles')
                ->type('points_per_kg', '-5')
                ->type('description', 'Clean plastic bottles without labels')
                ->press('Create Waste Type')

                // Verify validation error
                ->assertPathIs('/admin/points/values/create') // Ensure still on create page
                ->screenshot('negative_points_validation_error');
        });
    }
}

<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class Poin08Test extends DuskTestCase
{
    /**
     * Test admin can view total points in the system
     * @group Poin08Test
     */
    public function testViewTotalPoints(): void
    {
        $this->browse(function (Browser $browser) {
            // Login as admin
            $browser->visit('/login')
                ->type('email', 'admin@2caresampah.com')
                ->type('password', 'admin123')
                ->press('Login')
                ->waitForLocation('/admin/dashboard')
                ->assertPathIs('/admin/dashboard')

                // Verify total points issued and spent are visible
                ->assertSee('Total Points Issued')
                ->assertSee('Total Points Spent')

                // Take a screenshot for verification
                ->screenshot('view_total_points');
        });
    }
}

<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class Poin05Test extends DuskTestCase
{
    /**
     * Test determining reward based on points earned
     * @group Poin05Test
     */
    public function testDetermineRewardBasedOnPoints(): void
    {
        $this->browse(function (Browser $browser) {
            // Login as admin
            $browser->visit('/login')
                ->type('email', 'admin@2caresampah.com')
                ->type('password', 'admin123')
                ->press('Login')
                ->waitForLocation('/admin/dashboard')
                ->assertPathIs('/admin/dashboard')

                // Navigate to rewards management
                ->clickLink('Rewards')
                ->waitForLocation('/admin/rewards')
                ->assertPathIs('/admin/rewards')
                ->clickLink('Add New Reward')
                ->type('points_required', '1000')
                ->type('cash_value', '10000')
                ->press('Create Reward')
                ->assertPathIs('/admin/rewards')
                ->assertSee('Reward berhasil ditambahkan')

                // Take a screenshot for verification
                ->screenshot('determine_reward_based_on_points');
        });
    }
}

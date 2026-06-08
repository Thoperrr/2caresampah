<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class Poin06Test extends DuskTestCase
{
    /**
     * Test admin can edit reward details
     * @group Poin06Test
     */
    public function testEditRewardDetails(): void
    {
        $this->browse(function (Browser $browser) {
            // Login as admin
            $browser->visit('/')
                ->clickLink('Login')
                ->type('email', 'admin@2caresampah.com')
                ->type('password', 'admin123')
                ->press('Login')
                ->waitForLocation('/admin/dashboard')
                ->assertPathIs('/admin/dashboard')

                // Navigate to rewards management
                ->clickLink('Rewards')
                ->waitForLocation('/admin/rewards')
                ->assertPathIs('/admin/rewards')

                // Click edit link for the first reward
                ->waitFor('.text-indigo-600') // Wait for edit link
                ->click('.text-indigo-600') // Click edit link
                ->assertPathIs('/admin/rewards/*/edit') // Ensure on edit page

                // Edit the reward details
                ->waitFor('#points_required')
                ->clear('#points_required')
                ->type('#points_required', '500')
                ->clear('#cash_value')
                ->type('#cash_value', '100000')
                ->check('#is_active') // Ensure the reward is active
                ->press('Update Reward')

                // Verify the update was successful
                ->waitForLocation('/admin/rewards')
                ->waitFor('.bg-green-100') // Wait for success message
                ->assertSee('Reward berhasil diperbarui')
                ->screenshot('edit_reward_test_completed');
        });
    }
}
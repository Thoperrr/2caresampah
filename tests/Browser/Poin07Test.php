<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class Poin07Test extends DuskTestCase
{
    /**
     * Test admin can delete a reward
     * @group Poin07Test
     */
    public function testDeleteReward(): void
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

                // Ensure table is loaded and contains data
                ->waitFor('.min-w-full') // Wait for table to load
                ->assertPresent('tbody tr:first-child') // Ensure at least one row exists

                // Click delete button for the first reward
                ->tap(function (Browser $browser) {
                    $rewardName = $browser->text('tbody tr:first-child td:first-child');
                    $browser->script("window.rewardName = `${rewardName}`");
                })
                ->click('tbody tr:first-child button.text-red-600') // Click delete button
                ->waitFor('#deleteModal') // Wait for delete confirmation modal

                // Confirm deletion
                ->press('#deleteModal button[type="submit"]') // Confirm deletion

                // Verify the reward was deleted
                ->waitFor('.bg-green-100') // Wait for success message
                ->assertSee('Reward berhasil dihapus')
                ->assertScript('return !document.body.textContent.includes(window.rewardName)')
                ->screenshot('delete_reward_test_completed');
        });
    }
}

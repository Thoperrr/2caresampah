<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class Poin01Test extends DuskTestCase
{
    /**
     * Test admin can create new waste type with points
     * @group Poin01Test
     */
    public function testCreateWasteTypePoints(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->clickLink('Login')
                ->type('email', 'admin@2caresampah.com')
                ->type('password', 'admin123')
                ->press('Login')
                ->assertPathIs('/admin/dashboard')
                ->clickLink('Point Values')
                ->assertPathIs('/admin/points/values')
                ->clickLink('Add New Waste Type')
                ->assertPathIs('/admin/points/values/create')
                ->type('name', 'Plastic Bottles')
                ->type('points_per_kg', '5')
                ->type('description', 'Clean plastic bottles without labels')
                ->press('Create Waste Type')
                ->assertPathIs('/admin/points/values')
                ->assertSee('Plastic Bottles')
                ->assertSee('5')
                ->screenshot('poin01_test_screenshot');
        });
    }
}
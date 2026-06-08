<?php

namespace Tests\Browser\PointValues;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\Waste;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PointValuesCreateTest extends DuskTestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        // Create admin user if doesn't exist
        User::firstOrCreate(
            ['email' => 'admin1@example.com'],
            [
                'name' => 'Admin Test',
                'password' => bcrypt('admin123'),
                'role' => 'admin'
            ]
        );
    }

    /**
     * Test admin can create new waste type
     * @group point-values
     */
    public function testAdminCanCreateNewWasteType(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                // Login as admin
                ->type('email', 'admin1@example.com')
                ->type('password', 'admin123')
                ->press('Login')
                ->waitForLocation('/admin/dashboard')

                // Navigate to Point Values
                ->clickLink('Point Values')
                ->waitForLocation('/admin/points/values')
                ->assertSee('Add New Waste Type')

                // Create new waste type
                ->clickLink('Add New Waste Type')
                ->waitForLocation('/admin/points/values/create')
                ->type('name', 'Test Waste Type')
                ->type('points_per_kg', '15')
                ->type('description', 'This is a test waste type description')
                ->press('Create Waste Type')
                ->waitForLocation('/admin/points/values')

                // Verify success
                ->assertSee('Jenis sampah berhasil ditambahkan')
                ->assertSee('Test Waste Type')
                ->assertSee('15');
        });
    }

    /**
     * Test validation errors when creating waste type
     * @group point-values
     */
    public function testValidationWhenCreatingWasteType(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::where('email', 'admin1@example.com')->first())
                ->visit('/admin/points/values/create')

                // Submit empty form
                ->press('Create Waste Type')
                ->waitForText('Please fill out this field.');
        });
    }

    /**
     * Test duplicate waste type name validation
     * @group point-values
     */
    public function testDuplicateWasteTypeValidation(): void
    {
        // Create initial waste type
        Waste::create([
            'name' => 'Duplicate Test',
            'points_per_kg' => 10,
            'description' => 'Test description'
        ]);

        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::where('email', 'admin1@example.com')->first())
                ->visit('/admin/points/values/create')

                // Try to create duplicate
                ->type('name', 'Duplicate Test')
                ->type('points_per_kg', '15')
                ->press('Create Waste Type')

                // Verify duplicate validation error
                ->waitForText('The name has already been taken')
                ->assertSee('The name has already been taken');
        });
    }

    /**
     * Test points_per_kg must be non-negative
     * @group point-values
     */
    public function testPointsPerKgMustBeNonNegative(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::where('email', 'admin1@example.com')->first())
                ->visit('/admin/points/values/create')
                ->type('name', 'Test Waste')
                ->type('points_per_kg', '-5')
                ->press('Create Waste Type')
                ->assertSee('Value must be greater than or equal to 0');
        });
    }
}

<?php

namespace Tests;

use App\Models\Admin;
use App\Models\Customer;
use App\Models\Delegate;
use App\Models\ShopOwner;
use App\Models\Supervisor;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laraeast\LaravelSettings\Facades\Settings;
use Database\Seeders\RolesAndPermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp(): void
    {
        // first include all the normal setUp operations
        parent::setUp();

        // now re-register all the roles and permissions (clears cache and reloads relations)
        $this->app->make(\Spatie\Permission\PermissionRegistrar::class)->registerPermissions();

        $this->seed(RolesAndPermissionsSeeder::class);

        Settings::set('delete_forever', true);
    }

    /**
     * Set the currently logged in admin for the application.
     *
     * @param null $driver
     * @return \App\Models\Admin
     */
    public function actingAsAdmin($driver = null)
    {
        $admin = Admin::factory()->create();

        $this->be($admin, $driver);

        return $admin;
    }

    /**
     * Set the currently logged in supervisor for the application.
     *
     * @param null $driver
     * @return \App\Models\Supervisor
     */
    public function actingAsSupervisor($driver = null)
    {
        $supervisor = Supervisor::factory()->create();

        $this->be($supervisor, $driver);

        return $supervisor;
    }

    /**
     * Set the currently logged in customer for the application.
     *
     * @param null $driver
     * @return \App\Models\Customer
     */
    public function actingAsCustomer($driver = null)
    {
        $customer = Customer::factory()->create();

        $this->be($customer, $driver);

        return $customer;
    }

    /**
     * Set the currently logged in delegate for the application.
     *
     * @param null $driver
     * @return \App\Models\Delegate
     */
    public function actingAsDelegate($driver = null)
    {
        $delegate = Delegate::factory()->create();

        $this->be($delegate, $driver);

        return $delegate;
    }

    /**
     * Set the currently logged in shop owner for the application.
     *
     * @param null $driver
     * @return \App\Models\ShopOwner
     */
    public function actingAsShopOwner($driver = null)
    {
        $shop_owner = ShopOwner::factory()->create();

        $this->be($shop_owner, $driver);

        return $shop_owner;
    }

    /**
     * Determine wither the model use soft deleting trait.
     *
     * @param $model
     * @return bool
     */
    public function useSoftDeletes($model)
    {
        return in_array(
            SoftDeletes::class,
            array_keys((new \ReflectionClass($model))->getTraits())
        );
    }
}

<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create Permissions
        Permission::create(['name' => 'transactions-nav-view']);
        Permission::create(['name' => 'categories-nav-view']);
        Permission::create(['name' => 'companies-nav-view']);
        Permission::create(['name' => 'email-templates-nav-view']);
        Permission::create(['name' => 'acl-nav-view']);


        Role::create(['name' => 'admin'])->givePermissionTo(Permission::all());
        Role::create(['name' => 'company'])->givePermissionTo('transactions-nav-view');
        Role::create(['name' => 'customer'])->givePermissionTo('transactions-nav-view');
    }
}

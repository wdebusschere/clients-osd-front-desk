<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create the "admin" role and assign permissions.
        Role::create(['name' => 'admin'])->givePermissionTo(Permission::all());

        // Create the "employee" role and assign permissions.
        Role::create(['name' => 'employee'])->givePermissionTo([
            'users:view'
        ]);
    }
}

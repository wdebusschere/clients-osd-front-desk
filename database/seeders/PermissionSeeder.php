<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $defaultActions = ['view', 'create', 'update', 'delete'];

        $resources = [
            'activity logs' => ['view'],
            'locations' => $defaultActions,
            'delivery receipts' => $defaultActions,
            'roles' => $defaultActions,
            'users' => ['view', 'update', 'import from HQ'],
        ];

        foreach ($resources as $resource => $actions) {
            foreach ($actions as $action) {
                Permission::create(['name' => sprintf('%s:%s', $resource, $action)]);
            }
        }
    }
}

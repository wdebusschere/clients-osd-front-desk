<?php

namespace Database\Seeders;

use Database\Seeders\Dummy\DeliveryReceiptSeeder as DummyDeliveryReceiptSeeder;
use Database\Seeders\Dummy\LocationSeeder as DummyLocationSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        App::environment('production') ? $this->callRealSeeders() : $this->callDummySeeders();
    }

    protected function callRealSeeders(): void
    {
        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
        ]);
    }

    protected function callDummySeeders(): void
    {
        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            DummyLocationSeeder::class,
            DummyDeliveryReceiptSeeder::class
        ]);
    }
}

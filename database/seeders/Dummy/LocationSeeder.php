<?php

namespace Database\Seeders\Dummy;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Location::factory()->create(['name' => 'Stock']);
        Location::factory()->create(['name' => 'Warehouse']);
        Location::factory()->create(['name' => 'Pessoal']);
    }
}

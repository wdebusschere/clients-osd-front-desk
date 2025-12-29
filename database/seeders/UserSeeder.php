<?php

namespace Database\Seeders;

use App\Services\HQ\UsersImporter;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        (new UsersImporter)->import();
    }
}

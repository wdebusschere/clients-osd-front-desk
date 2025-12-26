<?php

namespace Database\Seeders;

use App\Models\RecipientType;
use Illuminate\Database\Seeder;

class RecipientTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RecipientType::create(['name' => 'Stock']);
        RecipientType::create(['name' => 'Warehouse']);
        RecipientType::create(['name' => 'Pessoal']);
    }
}

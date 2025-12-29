<?php

namespace Database\Seeders\Dummy;

use App\Models\DeliveryReceipt;
use Illuminate\Database\Seeder;

class DeliveryReceiptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DeliveryReceipt::factory(10)->create();
    }
}

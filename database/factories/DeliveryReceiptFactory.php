<?php

namespace Database\Factories;

use App\Models\RecipientType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class DeliveryReceiptFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'volumes' => fake()->numberBetween(1, 10),
            'observations' => fake()->text(),
            'recipient_type_id' => RecipientType::inRandomOrder()->first(),
            'user_id' => User::inRandomOrder()->first(),
            'recipient_id' => User::inRandomOrder()->first(),
        ];
    }
}

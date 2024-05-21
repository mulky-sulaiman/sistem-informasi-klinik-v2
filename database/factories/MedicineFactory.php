<?php

namespace Database\Factories;

use App\Models\Clinic;
use App\Models\MedicineCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Medicine>
 */
class MedicineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'clinic_id' => Clinic::factory(),
            'medicine_category_id' => MedicineCategory::factory(),
            'name' => fake()->word(),
            'description' => fake()->sentence(),
            'stock' => fake()->randomNumber(3, false),
            'price' => fake()->randomNumber(6, true),
            'is_in_stock' => fake()->randomElement([0, 1]),
        ];
    }
}

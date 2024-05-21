<?php

namespace Database\Seeders;

use App\Models\Medicine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedicineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($c = 1; $c <= 10; $c++) {
            for ($m = 1; $m <= 39; $m++) {
                Medicine::factory()->create([
                    'clinic_id' => $c,
                    'medicine_category_id' => $m,
                    'name' => fake()->word(),
                    'description' => fake()->sentence(),
                    'stock' => fake()->randomNumber(3, false),
                    'price' => fake()->randomNumber(6, true),
                    'is_in_stock' => fake()->randomElement([0, 1]),
                ]);
            }
        }
    }
}

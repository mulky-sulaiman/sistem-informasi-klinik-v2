<?php

namespace Database\Factories;

use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Village;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Clinic>
 */
class ClinicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $village = Village::inRandomOrder()->limit(1)->get()->first();
        $district = $village->district;
        $regency = $district->regency;
        $province = $regency->province;
        return [
            'name' => fake()->randomElement(['Klinik Pratama', 'Klinik Utama']) . ' ' . ucfirst(fake()->word()),
            'description' => fake()->sentence(),
            'address' => fake()->address(),
            'province_id' => $province->id,
            'regency_id' => $regency->id,
            'district_id' => $district->id,
            'village_id' => $village->id,
        ];
    }
}

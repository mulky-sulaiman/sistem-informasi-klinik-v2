<?php

namespace Database\Factories;

use App\Enums\AppointmentStatusEnum;
use App\Models\Clinic;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fee = fake()->numberBetween(100000, 300000);
        $discount = fake()->randomElement([0, 25, 50, 75, 100]);
        $amount = $fee - ($fee * ($discount / 100));
        return [
            'clinic_id' => Clinic::factory(),
            'patient_id' => Patient::factory(),
            'doctor_id' => User::factory(),
            'schedule_date' => fake()->dateTimeBetween('-1 week', '+1 week'),
            'height' => fake()->numberBetween(140, 200),
            'weight' => fake()->numberBetween(40, 120),
            'blood_pressure' => fake()->numberBetween(50, 200) . '/' . fake()->numberBetween(50, 200),
            'symptoms' => fake()->paragraphs(2, true),
            'diagnostic' => fake()->paragraphs(2, true),
            'doctor_fee' => $fee,
            'discount' => $discount,
            'amount' => $amount,
            'status' => fake()->randomElement(AppointmentStatusEnum::values())
        ];
    }
}

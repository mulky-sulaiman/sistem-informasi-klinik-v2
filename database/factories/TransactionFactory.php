<?php

namespace Database\Factories;

use App\Enums\PaymentStatusEnum;
use App\Models\Appointment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'appointment_id' => Appointment::factory(),
            'patient_name' => fake()->name(),
            'patient_phone' => fake()->phoneNumber(),
            'patient_age' => fake()->numberBetween(1, 100),
            'doctor_name' => fake()->name(),
            'doctor_phone' => fake()->phoneNumber(),
            'appointment_date' => fake()->dateTimeBetween('-1 week', '+1 week'),
            'note' => fake()->paragraphs(2, true),
            'status' => fake()->randomElement(PaymentStatusEnum::values()),
            'paid_at' => fake()->randomElement([now(), null]),
        ];
    }
}

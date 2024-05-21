<?php

namespace Database\Factories;

use App\Enums\PaymentStatusEnum;
use App\Models\Appointment;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bill>
 */
class BillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $qty = fake()->numberBetween(1, 10);
        $price = fake()->numberBetween(100000, 300000);
        $discount = fake()->randomElement([0, 25, 50, 75, 100]);
        $amount = $price - ($price * ($discount / 100));
        // $status = fake()->randomElement(PaymentStatusEnum::values());
        // $paid_at =  ($status == PaymentStatusEnum::PAID->value) ? now() : null;
        return [
            'transaction_id' => Transaction::factory(),
            'item_name' => fake()->word(),
            'item_description' => fake()->sentence(),
            'quantity' => $qty,
            'price' => $price,
            'discount' => $discount,
            'amount' => $amount,
            // 'status' => $status,
            // 'paid_at' => $paid_at,
        ];
    }
}

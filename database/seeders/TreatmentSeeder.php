<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Treatment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TreatmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $appointments = Appointment::all();
        foreach ($appointments as $appointment) {
            // Inject Doctor's Fee
            $qty = 1;
            $fee = $appointment->doctor_fee;
            $discount = $appointment->discount;
            $amount = $appointment->amount;
            Treatment::factory()->create([
                'treatment_category_id' => 1,
                'appointment_id' => $appointment->id,
                'name' => 'Doctor\'s Fee',
                'description' => $appointment->diagnostic,
                'quantity' => $qty,
                'price' => $fee,
                'discount' => $discount,
                'amount' => $amount,
            ]);
            // Seed the rests
            Treatment::factory()->count(2)->create([
                'treatment_category_id' => fake()->randomElement([2, 3, 4]),
                'appointment_id' => $appointment->id,
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Bill;
use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transactions = Transaction::all();
        foreach ($transactions as $transaction) {
            $appointment = $transaction->appointment()->first();
            // Treatments
            $treatments = $appointment->treatments()->get();
            foreach ($treatments as $treatment) {
                Bill::factory()->create([
                    'transaction_id' => $transaction->id,
                    'item_name' => $treatment->name,
                    'item_description' => $treatment->description,
                    'quantity' => $treatment->quantity,
                    'price' => $treatment->price,
                    'discount' => $treatment->discount,
                    'amount' => $treatment->amount
                ]);
            }
            // Prescriptions
            $prescriptions = $appointment->prescriptions()->get();
            foreach ($prescriptions as $prescription) {
                Bill::factory()->create([
                    'transaction_id' => $transaction->id,
                    'item_name' => $prescription->medicine()->first()->name,
                    'item_description' => $prescription->description,
                    'quantity' => $prescription->quantity,
                    'price' => $prescription->price,
                    'discount' => $prescription->discount,
                    'amount' => $prescription->amount
                ]);
            }
        }
    }
}

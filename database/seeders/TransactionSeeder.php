<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $appointments = Appointment::all();
        foreach ($appointments as $appointment) {
            // Patient & Doctor Info
            $patient = $appointment->patient()->first();
            $doctor = $appointment->doctor()->first();
            Transaction::factory()->create([
                'appointment_id' => $appointment->id,
                'patient_name' => $patient->name,
                'patient_phone' => $patient->phone,
                'patient_age' => $patient->age,
                'doctor_name' => $doctor->name,
                'doctor_phone' => $doctor->phone,
                'appointment_date' => $appointment->schedule_date,
                'note' => $appointment->symptoms . '\n' . $appointment->diagnostic,
            ]);
        }
    }
}

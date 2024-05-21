<?php

namespace Database\Seeders;

use App\Models\Appointment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clinics = 10;
        $total_patients = 20;
        $patients_per_clinic = $total_patients / $clinics;

        for ($i = 1; $i <= $clinics; $i++) {
            for ($j = 1; $j <= $patients_per_clinic; $j++) {
                $patient = ($i - 1) * $patients_per_clinic + $j;
                Appointment::factory()->create([
                    'clinic_id' => $i,
                    'patient_id' => $patient,
                    'doctor_id' => fake()->randomElement([6, 7, 8]),
                ]);
            }
        }
    }
}

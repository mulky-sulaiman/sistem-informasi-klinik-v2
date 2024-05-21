<?php

namespace Database\Seeders;

use App\Models\Prescription;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrescriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $appointments = 20;
        for ($i = 1; $i <= $appointments; $i++) {
            $medicine_id = fake()->randomNumber(1, 39);
            Prescription::factory()->count(2)->create([
                'medicine_id' => $medicine_id,
                'appointment_id' => $i,
            ]);
        }
    }
}

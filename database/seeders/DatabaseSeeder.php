<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            IndoRegionSeeder::class,
            ClinicSeeder::class,
            PermissionSeeder::class,
            UserSeeder::class,
            MedicineCategorySeeder::class,
            MedicineSeeder::class,
            PatientSeeder::class,
            AppointmentSeeder::class,
            TreatmentCategorySeeder::class,
            TreatmentSeeder::class,
            PrescriptionSeeder::class,
            TransactionSeeder::class,
            BillSeeder::class,
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // 1. Super Admin
        $u = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            // 'role' => RoleEnum::SUPER_ADMIN->value,
        ]);
        $u->assignRole(RoleEnum::SUPER_ADMIN->value);

        // 2. Admin
        $u = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            // 'role' => RoleEnum::ADMIN->value,
        ]);
        $u->assignRole(RoleEnum::ADMIN->value);

        // 3. Operator
        $u = User::factory()->create([
            'name' => 'Operator Receiptionist',
            'email' => 'operator@example.com',
            // 'role' => RoleEnum::OPERATOR->value,
        ]);
        $u->assignRole(RoleEnum::OPERATOR->value);

        // 4. Pharmacist (1)
        $u = User::factory()->create([
            'name' => 'Phramacist 1',
            'email' => 'pharmacist.1@example.com',
            // 'role' => RoleEnum::PHARMACIST->value,
        ]);
        $u->assignRole(RoleEnum::PHARMACIST->value);

        // 5. Pharmacist (2)
        $u = User::factory()->create([
            'name' => 'Pharmacist 2',
            'email' => 'pharmacist.2@example.com',
            // 'role' => RoleEnum::PHARMACIST->value,
        ]);
        $u->assignRole(RoleEnum::PHARMACIST->value);

        // 6. Doctor (1)
        $u = User::factory()->create([
            'name' => 'Doctor 1',
            'email' => 'doctor.1@example.com',
            // 'role' => RoleEnum::DOCTOR->value,
            'fee' => 100000
        ]);
        $u->assignRole(RoleEnum::DOCTOR->value);

        // 7. Doctor (2)
        $u = User::factory()->create([
            'name' => 'Doctor 2',
            'email' => 'doctor.2@example.com',
            // 'role' => RoleEnum::DOCTOR->value,
            'fee' => 200000
        ]);
        $u->assignRole(RoleEnum::DOCTOR->value);

        // 8. Doctor (3)
        $u = User::factory()->create([
            'name' => 'Doctor 3',
            'email' => 'doctor.3@example.com',
            // 'role' => RoleEnum::DOCTOR->value,
            'fee' => 300000
        ]);
        $u->assignRole(RoleEnum::DOCTOR->value);
    }
}

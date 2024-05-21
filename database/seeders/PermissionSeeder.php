<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\{Permission, Role};
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'create_role',
            'view_any_role',
            'view_role',
            'update_role',
            'delete_any_role',
            'delete_role',
            'create_user',
            'view_any_user',
            'view_user',
            'update_user',
            'delete_any_user',
            'delete_user',
            'create_clinic',
            'view_any_clinic',
            'view_clinic',
            'update_clinic',
            'delete_any_clinic',
            'delete_clinic',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $superadmin = Role::create(['name' => RoleEnum::SUPER_ADMIN->value]);

        $superadmin->syncPermissions($permissions);

        $admin = Role::create(['name' => RoleEnum::ADMIN->value]);

        $admin->syncPermissions([
            'create_user',
            'view_any_user',
            'view_user',
            'update_user',
            'delete_any_user',
            'delete_user',
            'view_any_clinic',
            'view_clinic',
            'update_clinic',
        ]);

        $operator = Role::create(['name' => RoleEnum::OPERATOR->value]);

        $operator->syncPermissions([
            'view_any_user',
            'view_user',
            'update_user',
            'view_any_clinic',
            'view_clinic',
        ]);

        $operator = Role::create(['name' => RoleEnum::PHARMACIST->value]);

        $operator->syncPermissions([
            'view_user',
            'update_user',
            'view_any_clinic',
            'view_clinic',
        ]);

        $operator = Role::create(['name' => RoleEnum::DOCTOR->value]);

        $operator->syncPermissions([
            'view_user',
            'update_user',
            'view_any_clinic',
            'view_clinic',
        ]);
    }
}

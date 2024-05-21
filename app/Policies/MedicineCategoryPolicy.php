<?php

namespace App\Policies;

use App\Enums\RoleEnum;
use App\Models\MedicineCategory;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MedicineCategoryPolicy
{
    public function before(User $user, string $ability): bool|null
    {
        //if ($user->hasRole(RoleEnum::SUPER_ADMIN->value) || $user->hasRole(RoleEnum::ADMIN->value)) {
        if (in_array($user->getRoleNames()->first(), [RoleEnum::SUPER_ADMIN->value, RoleEnum::ADMIN->value])) {

            return true;
        }

        return null; // see the note above in Gate::before about why null must be returned here.
    }
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, MedicineCategory $medicineCategory): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, MedicineCategory $medicineCategory): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, MedicineCategory $medicineCategory): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, MedicineCategory $medicineCategory): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, MedicineCategory $medicineCategory): bool
    {
        //
    }
}

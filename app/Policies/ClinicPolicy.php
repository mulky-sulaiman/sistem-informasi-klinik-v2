<?php

namespace App\Policies;

use App\Enums\RoleEnum;
use App\Models\Clinic;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ClinicPolicy
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
    public function view(User $user, Clinic $clinic): bool
    {
        return (in_array('view_clinic', $user->getPermissionsViaRoles()->pluck('name')->toArray()));
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return (in_array('create_clinic', $user->getPermissionsViaRoles()->pluck('name')->toArray()));
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Clinic $clinic): bool
    {
        return (in_array('update_clinic', $user->getPermissionsViaRoles()->pluck('name')->toArray()));
    }

    /**
     * Determine whether the user can delete any model.
     */
    public function deleteAny(User $user): bool
    {
        return (in_array('delete_any_clinic', $user->getPermissionsViaRoles()->pluck('name')->toArray()));
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user,  Clinic $clinic): bool
    {
        return (in_array('delete_clinic', $user->getPermissionsViaRoles()->pluck('name')->toArray()));
    }
}

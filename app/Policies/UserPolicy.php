<?php

namespace App\Policies;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
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
        // return (in_array('view_any_user', $user->getPermissionsViaRoles()->pluck('name')->toArray()));
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        return (in_array('view_user', $user->getPermissionsViaRoles()->pluck('name')->toArray()) && $user->id == $model->id);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return (in_array('create_user', $user->getPermissionsViaRoles()->pluck('name')->toArray()));
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        return (in_array('update_user', $user->getPermissionsViaRoles()->pluck('name')->toArray()) && $user->id == $model->id);
    }

    /**
     * Determine whether the user can delete any model.
     */
    public function deleteAny(User $user): bool
    {
        return (in_array('delete_any_user', $user->getPermissionsViaRoles()->pluck('name')->toArray()));
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        return (in_array('delete_user', $user->getPermissionsViaRoles()->pluck('name')->toArray()) && $user->id == $model->id);
    }
}

<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\MakeModel;
use App\Models\User;

class MakeModelPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any MakeModel');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, MakeModel $makemodel): bool
    {
        return $user->checkPermissionTo('view MakeModel');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create MakeModel');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, MakeModel $makemodel): bool
    {
        return $user->checkPermissionTo('update MakeModel');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, MakeModel $makemodel): bool
    {
        return $user->checkPermissionTo('delete MakeModel');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, MakeModel $makemodel): bool
    {
        return $user->checkPermissionTo('restore MakeModel');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, MakeModel $makemodel): bool
    {
        return $user->checkPermissionTo('force-delete MakeModel');
    }
}

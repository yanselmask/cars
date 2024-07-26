<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\FrontSection;
use App\Models\User;

class FrontSectionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any FrontSection');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, FrontSection $frontsection): bool
    {
        return $user->checkPermissionTo('view FrontSection');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create FrontSection');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, FrontSection $frontsection): bool
    {
        return $user->checkPermissionTo('update FrontSection');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, FrontSection $frontsection): bool
    {
        return $user->checkPermissionTo('delete FrontSection');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, FrontSection $frontsection): bool
    {
        return $user->checkPermissionTo('restore FrontSection');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, FrontSection $frontsection): bool
    {
        return $user->checkPermissionTo('force-delete FrontSection');
    }
}

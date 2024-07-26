<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Feature;
use App\Models\User;

class FeaturePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any Feature');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Feature $feature): bool
    {
        return $user->checkPermissionTo('view Feature');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create Feature');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Feature $feature): bool
    {
        return $user->checkPermissionTo('update Feature');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Feature $feature): bool
    {
        return $user->checkPermissionTo('delete Feature');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Feature $feature): bool
    {
        return $user->checkPermissionTo('restore Feature');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Feature $feature): bool
    {
        return $user->checkPermissionTo('force-delete Feature');
    }
}

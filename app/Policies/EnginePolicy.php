<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Engine;
use App\Models\User;

class EnginePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any Engine');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Engine $engine): bool
    {
        return $user->checkPermissionTo('view Engine');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create Engine');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Engine $engine): bool
    {
        return $user->checkPermissionTo('update Engine');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Engine $engine): bool
    {
        return $user->checkPermissionTo('delete Engine');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Engine $engine): bool
    {
        return $user->checkPermissionTo('restore Engine');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Engine $engine): bool
    {
        return $user->checkPermissionTo('force-delete Engine');
    }
}

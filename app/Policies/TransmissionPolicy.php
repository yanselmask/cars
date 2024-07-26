<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Transmission;
use App\Models\User;

class TransmissionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any Transmission');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Transmission $transmission): bool
    {
        return $user->checkPermissionTo('view Transmission');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create Transmission');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Transmission $transmission): bool
    {
        return $user->checkPermissionTo('update Transmission');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Transmission $transmission): bool
    {
        return $user->checkPermissionTo('delete Transmission');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Transmission $transmission): bool
    {
        return $user->checkPermissionTo('restore Transmission');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Transmission $transmission): bool
    {
        return $user->checkPermissionTo('force-delete Transmission');
    }
}

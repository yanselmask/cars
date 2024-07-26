<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\DriveType;
use App\Models\User;

class DriveTypePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any DriveType');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, DriveType $drivetype): bool
    {
        return $user->checkPermissionTo('view DriveType');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create DriveType');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, DriveType $drivetype): bool
    {
        return $user->checkPermissionTo('update DriveType');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, DriveType $drivetype): bool
    {
        return $user->checkPermissionTo('delete DriveType');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, DriveType $drivetype): bool
    {
        return $user->checkPermissionTo('restore DriveType');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, DriveType $drivetype): bool
    {
        return $user->checkPermissionTo('force-delete DriveType');
    }
}

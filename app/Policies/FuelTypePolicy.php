<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\FuelType;
use App\Models\User;

class FuelTypePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any FuelType');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, FuelType $fueltype): bool
    {
        return $user->checkPermissionTo('view FuelType');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create FuelType');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, FuelType $fueltype): bool
    {
        return $user->checkPermissionTo('update FuelType');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, FuelType $fueltype): bool
    {
        return $user->checkPermissionTo('delete FuelType');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, FuelType $fueltype): bool
    {
        return $user->checkPermissionTo('restore FuelType');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, FuelType $fueltype): bool
    {
        return $user->checkPermissionTo('force-delete FuelType');
    }
}

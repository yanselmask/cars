<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\OfferType;
use App\Models\User;

class OfferTypePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any OfferType');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, OfferType $offertype): bool
    {
        return $user->checkPermissionTo('view OfferType');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create OfferType');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, OfferType $offertype): bool
    {
        return $user->checkPermissionTo('update OfferType');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, OfferType $offertype): bool
    {
        return $user->checkPermissionTo('delete OfferType');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, OfferType $offertype): bool
    {
        return $user->checkPermissionTo('restore OfferType');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, OfferType $offertype): bool
    {
        return $user->checkPermissionTo('force-delete OfferType');
    }
}

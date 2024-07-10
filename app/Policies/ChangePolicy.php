<?php

namespace App\Policies;

use App\Models\Change;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ChangePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    // public function viewAny(User $user): bool
    // {
    //     //
    // }

    // /**
    //  * Determine whether the user can view the model.
    //  */
    // public function view(User $user, Change $change): bool
    // {
    //     //
    // }

    // /**
    //  * Determine whether the user can create models.
    //  */
    // public function create(User $user): bool
    // {
    //     //
    // }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Change $change): bool
    {
        return $user->hasPermissionTo('change_update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Change $change): bool
    {
        return $user->hasPermissionTo('change_delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    // public function restore(User $user, Change $change): bool
    // {
    //     //
    // }

    // /**
    //  * Determine whether the user can permanently delete the model.
    //  */
    // public function forceDelete(User $user, Change $change): bool
    // {
    //     //
    // }
}

<?php

namespace App\Policies;

use App\Models\ProjectUser;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProjectUserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('can_access_assign_project');
    }

   
}

<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * This method runs before any other policy method.
     * Super admins bypass all checks.
     */
    public function before(User $user, $ability)
    {
        if ($user->type === 'super_admin') {
            return true;
        }
    }

    /**
     * Determine whether the user can view any users.
     */
    public function viewAny(User $user)
    {
        return $user->hasPermission('users.index');
    }

    /**
     * Determine whether the user can view a specific user.
     */
    public function view(User $user, User $model)
    {
        return $user->hasPermission('users.index');
    }

    /**
     * Determine whether the user can create users.
     */
    public function create(User $user)
    {
        return $user->hasPermission('users.create');
    }

    /**
     * Determine whether the user can update a user.
     */
    public function update(User $user, User $model)
    {
        return $user->hasPermission('users.update');
    }

    /**
     * Determine whether the user can delete a user.
     */
    public function delete(User $user, User $model)
    {
        return $user->hasPermission('users.delete');
    }
}
<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function view(User $user, User $targetUser)
    {
        // Allow users with the 'admin' role to view any user
        return $user->hasRole('admin');
    }

    public function edit(User $user, User $targetUser)
    {
        // Allow users to edit their own profile
        return $user->id === $targetUser->id;
    }

    public function delete(User $user, User $targetUser)
    {
        // Allow users with the 'admin' role to delete any user
        return $user->hasRole('admin');
    }
}

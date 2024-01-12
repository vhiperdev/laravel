<?php

namespace App\Policies;

use App\Models\User;

class MessageTemplatePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function view(User $user)
    {
        // Authorization logic for viewing a post 
        return $user->hasRole('admin');
    }

    public function list(User $user)
    {
        // Authorization logic for viewing a post 
        return $user->hasRole('admin');
    }

    public function store(User $user)
    {
        // Authorization logic for creating a customer 
        return $user->hasRole('admin') || $user->hasRole('reseller');
    }

    public function update(User $user)
    {
        // Authorization logic for creating a customer 
        return $user->hasRole('admin') || $user->hasRole('reseller');
    }

    public function destroy(User $user)
    {
        return $user->hasRole('admin') || $user->hasRole('reseller');
    }
}

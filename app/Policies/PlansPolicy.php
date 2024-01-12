<?php

namespace App\Policies;

use App\Models\Plans;
use App\Models\User;

class PlansPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function view(User $user, Plans $plan)
    {
        // Authorization logic for viewing a post 
        return $user->hasRole('admin') || $user->hasRole('reseller');
    }

    public function list(User $user)
    {
        // Authorization logic for viewing a post 
        return $user->hasRole('admin') || $user->hasRole('reseller');
    }

    public function store(User $user)
    {
        // Authorization logic for creating a customer 
        return $user->hasRole('admin') || $user->hasRole('reseller');
    }

    public function edit(User $user)
    {
        // Authorization logic for creating a customer 
        return $user->hasRole('admin') || $user->hasRole('reseller');
    }

    public function destroy(User $user)
    {
        return $user->hasRole('admin');
    }

    public function update(User $user, Plans $plans)
    {
        // Authorization logic for updating a plan
        return $user->id === $plans->created_by; // Allow only the plan owner to update
    }
}

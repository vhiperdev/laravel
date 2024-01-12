<?php

namespace App\Policies;

use App\Models\Customers;
use App\Models\User;

class BillingPolicy
{
    public function view(User $user, Customers $customer)
    {
        // Authorization logic for viewing a post 
        return $user->hasRole('admin') || $user->id === $customer->user_id;
    }

    public function update(User $user, Customers $customer)
    {
        // Authorization logic for updating a customer
        return $user->hasRole('admin') || $user->id === $customer->user_id; // Allow only the post owner to update
    }

    public function create(User $user)
    {
        // Authorization logic for creating a customer 
        return $user->hasRole('admin');
    }

    public function store(User $user)
    {
        // Authorization logic for creating a customer 
        return $user->hasRole('admin') || $user->hasRole('reseller');
    }

    public function edit(User $user)
    {
        // Authorization logic for creating a customer 
        return $user->hasRole('admin');
    }

    public function list(User $user)
    {
        return $user->hasRole('admin') || $user->hasRole('reseller');
    }

    public function destroy(User $user)
    {
        return $user->hasRole('admin');
    }


    public function customer_subscription_list(User $user)
    {
        return $user->hasRole('admin') || $user->hasRole('reseller');
    }
}

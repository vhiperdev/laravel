<?php

namespace App\Rules;

use App\Models\Subscription;
use Illuminate\Contracts\Validation\Rule;
use App\Models\User;

class NonUniqueSubscription implements Rule
{
    public function passes($attribute, $value)
    {
        // Check if the value is not unique in the users table
        return !Subscription::where($attribute, $value)->where('reseller_id', auth()->user()->id)->exists();
    }

    public function message()
    {
        return 'The :attribute has already been taken.';
    }
}

<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\User;

class NonUnique implements Rule
{
    public function passes($attribute, $value)
    {
        // Check if the value is not unique in the users table
        return !User::where($attribute, $value)->exists();
    }

    public function message()
    {
        return 'The :attribute has already been taken.';
    }
}

<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Validation\Rule;

class IsValidRegistration implements Rule
{
    public function passes($attribute, $value)
    {
        $user = User::withTrashed()->where('email', $value)->first();

        if ($user && $user->deleted_at !== null) {
            return false; // Registration not valid
        }

        return true; // Registration is valid
    }

    public function message()
    {
        return 'Please contact admin to register again.';
    }
}

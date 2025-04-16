<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function fetchMe(User $user): bool
    {
        return true;
    }
}

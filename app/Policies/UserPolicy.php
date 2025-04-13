<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function fetchMe(User $user, User $target): bool
    {
        return true;
    }
}

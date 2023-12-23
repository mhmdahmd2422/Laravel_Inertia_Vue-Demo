<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->email === 'dodov@mailinator.com';
    }

    /**
     * Determine whether the user can edit models.
     */
    public function edit(User $user, User $model): bool
    {
        return $user->email === 'dodov@mailinator.com';
    }
}

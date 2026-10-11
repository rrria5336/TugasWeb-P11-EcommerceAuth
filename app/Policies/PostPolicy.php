<?php

namespace App\Policies;

use App\Models\User;

class PostPolicy
{
    public function update(User $user): bool
    {
        return in_array($user->role, ['admin', 'editor']);
    }

    public function delete(User $user): bool
    {
        return $user->role === 'admin';
    }
}
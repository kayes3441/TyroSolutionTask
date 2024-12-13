<?php

namespace App\Policies;

use App\Models\User;

class TaskPolicy
{
    public function view(User $user): bool
    {
        return in_array($user->role, ['Admin', 'Manager', 'Employee']);
    }

    public function store(User $user): bool
    {
        return in_array($user->role, ['Admin', 'Manager']);
    }

    public function update(User $user): bool
    {
        return in_array($user->role, ['Admin', 'Manager']);
    }

    public function delete(User $user): bool
    {
        return $user->role === 'Admin';
    }
}

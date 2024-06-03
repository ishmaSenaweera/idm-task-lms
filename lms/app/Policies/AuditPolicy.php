<?php

namespace App\Policies;

use App\Models\User;

class AuditPolicy
{

    /**
     * Determine whether the user can view audits.
     */
    public function view(User $user)
    {

        return $user->role === 'Admin';
    }

    /**
     * Determine whether the user can download audits.
     */
    public function download(User $user)
    {
        return $user->role === 'Admin';
    }
}

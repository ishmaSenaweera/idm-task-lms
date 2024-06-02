<?php

namespace App\Policies;

use App\Models\Module;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ModulePolicy
{
    /**
     * All users can view modules.
     */
    public function view(User $user, Module $module)
    {
        return in_array($user->role, ['Admin', 'Teacher', 'Academic Head', 'Student']);
    }

    /**
     * Only admin or academic head can create a module.
     */
    public function create(User $user)
    {
        return in_array($user->role, ['Admin', 'Academic Head']);
    }

    /**
     * Only admin or academic head can update a module.
     */
    public function update(User $user, Module $module)
    {
        return in_array($user->role, ['Admin', 'Academic Head']);
    }

    /**
     * Only admin or academic head can delete a module.
     */
    public function delete(User $user, Module $module)
    {
        return in_array($user->role, ['Admin', 'Academic Head']);
    }
}

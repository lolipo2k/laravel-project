<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    public function created(User $user)
    {
        if ($user->id == 1)
        {
            $user->assignRole('admin');
        }
    }
}

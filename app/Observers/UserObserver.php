<?php

namespace App\Observers;

use App\Models\User;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class UserObserver
{
    public function saving(User $user)
    {
        $user->activation_token = str_random(30);
    }

    public function updating(User $user)
    {
        //
    }
}
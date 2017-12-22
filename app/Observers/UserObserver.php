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
        // 这样写扩展性更高，只有空的时候才指定默认头像
        if (empty($user->avatar)) {
            $user->avatar = '/default-avatar.jpg';
        }
    }

    public function updating(User $user)
    {
        //
    }
}
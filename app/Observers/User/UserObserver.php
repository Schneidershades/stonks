<?php

namespace App\Observers\User;

use App\Models\User;
use App\Models\Wallet;

class UserObserver
{
    public function creating(User $user)
    {
        // hash the user password
        $user->password = bcrypt($user->password);
    }

    public function created(User $user)
    {
        // create new wallet for the user
        $wallet = new Wallet;
        $wallet->user_id = $user->id;
        $wallet->save();
    }
}

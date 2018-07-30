<?php

namespace App\Policies;

use App\User;
use App\Votation;
use Illuminate\Auth\Access\HandlesAuthorization;

class VotationPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function manipulate(User $user, Votation $poll)
    {
        return $user->id === $poll->user_id;
    }

    public function remove(User $user, Votation $poll)
    {
        return $user->id === $poll->user_id;
    }
}

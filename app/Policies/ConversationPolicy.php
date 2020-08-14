<?php

namespace App\Policies;

use App\Conversation;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ConversationPolicy
{
    use HandlesAuthorization;

    // public function before(User $user)
    // {
    //     if ($user->id === 3) {
    //         return true;
    //     }
    // }

    /**
     * Determine whether the user can update the conversation.
     *
     * @param  \App\User  $user
     * @param  \App\Conversation  $conversation
     * @return mixed
     */
    // public function create(User $user, Conversation $conversation)
    public function update(User $user, Conversation $conversation)
    {
        return $conversation->user->is($user);
    }

}

<?php

namespace App\Policies;

use App\Message;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MessagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the message.
     * アクセスしているユーザーidとメッセージのユーザーidが一致する場合のみ閲覧可能。
     */
    public function view(User $user, Message $message)
    {
        return $user->id === $message->user_id;
    }
}

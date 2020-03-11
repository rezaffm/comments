<?php

namespace App\Policies;

use App\User;
use App\Comment;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    public function reply($user, $comment) {
        return !$comment->parent_id;
    }

    public function update($user, $comment) {
        return $user->id == $comment->user_id;
    }
}

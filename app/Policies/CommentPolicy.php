<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    public function reply(User $auth, Comment $comment)
    {
        return $auth->id !== $comment->user_id;
    }

    //Проверка комментарий был написан авторизованным пользователем или этот комментарий относится к профилю авторизованного пользователя
    public function delete(User $auth, Comment $comment)
    {
        return (($auth->id === $comment->user_id) || ($auth->id === $comment->profile_user_id));
    }
}

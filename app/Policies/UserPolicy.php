<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function add_comment(User $auth, User $user)
    {
        return $auth->id === $user->id;
    }

    public function delete_comment(User $auth, User $user, Comment $comment)
    {
        return ($auth->id === $user->id) || ($auth->id === $comment->parent->user_id) || ($auth->id === $comment->user_id);
    }

    public function reply_comment(User $auth, User $user, Comment $comment)
    {
        return ($auth->id === $user->id) || ($auth->id !== $comment->user_id);
    }

    public function view_library(User $auth, User $user)
    {
        return $auth->id === $user->id || $user->sharedUsers->contains($auth);
    }

    public function view_book(User $auth, User $user, Book $book)
    {
        return $book->link_access || $auth->id === $user->id || $user->sharedUsers->contains($auth);
    }

    public function share_library(User $auth, User $user)
    {
        return $auth->id !== $user->id && !$auth->sharedUsers->contains($user);
    }

    public function deny_library(User $auth, User $user)
    {
        return $auth->id !== $user->id && $auth->sharedUsers->contains($user);
    }
}

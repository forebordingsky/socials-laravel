<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\Request;

class CommentController extends Controller
{
    /**
     * Возвращает страницу пользователя со всеми его комментариями
     *
     * @param User $user
     * @return void
     */
    public function all(User $user)
    {
        $comments = Comment::where('user_id',$user->id)->with('parent.user')->orderBy('updated_at','desc')->get();
        return view('comments',compact('user','comments'));
    }

    /**
     * Заносит в базу новый комментарий пользователя
     *
     * @param CommentRequest $request
     * @param User $user
     * @return void
     */
    public function add(CommentRequest $request, User $user)
    {
        $data = $request->validated();
        $user->comments()->create([
            'header' => $data['header'],
            'description' => $data['description'],
            'profile_user_id' => $user->id,
            'user_id' => $user->id
        ]);
        return back()->with('message', 'Success');
    }

    /**
     * Заносит в базу комментарий на комментарий другого пользователя
     *
     * @param CommentRequest $request
     * @param Comment $comment
     * @return void
     */
    public function reply(CommentRequest $request, User $user, Comment $comment)
    {
        $data = $request->validated();

        $comment->replies()->create([
            'header' => $data['header'],
            'description' => $data['description'],
            'profile_user_id' => $user->id,
            'user_id' => auth()->user()->id
        ]);
        return back()->with('message', 'Success');
    }

    /**
     * Изменяет статус на 'удален', если у комментария есть ответы. Иначе удаляет комментарий
     *
     * @param Request $request
     * @param Comment $comment
     * @return void
     */
    public function delete(Request $request, Comment $comment)
    {
        //Если есть дочерние комментарии, то не удаляем, а изменяем статус
        if (count($comment->replies)) {
            $comment->update(['deleted' => true]);
        }
        //Иначе удаляем из базы
        else {
            //Если есть родитель и он имеет статус удаленного, то удаляем родителя
            if ($comment->parent && $comment->parent->deleted == true) {
                $comment->parent->delete();
            }
            $comment->delete();
        }
        return back()->with('message', 'Success');
    }

    /**
     * Возвращет остальные комментарии пользователя в JSON формате
     *
     * @param User $user
     * @return void
     */
    public function getRestJSON(User $user)
    {
        $user->load('lastComments')->orderBy('updated_at','desc');
        return response()->json($user->lastComments);
    }
}

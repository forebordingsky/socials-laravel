<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Requests\DeleteCommentRequest;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{

    public function getAllProfiles()
    {
        $users = User::withCount('comments')->get();
        return view('home',compact('users'));
    }

    public function profilePage(User $user)
    {
        $user->load('latestComments')->loadCount('comments');
        //$user->load('lastComments.replies')->orderBy('updated_at','desc');
        return view('profile',compact('user'));
    }

    public function getUserComments(User $user)
    {
        if (!Gate::allows('access_comments',$user)) {
            abort(403);
        }
        $user = $user->load('comments');
        return view('comments',compact('user'));
    }

    public function addComment(CommentRequest $request)
    {
        auth()->user()->comments()->create($request->validated());
        return back()->with('message', 'Success');
    }

    public function deleteComment(DeleteCommentRequest $request)
    {
        //TODO authorize method
        $comment = Comment::findOrFail($request->validated()['id']);
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

    public function getAllCommentsJSON(User $user)
    {
        $user->load('lastComments')->orderBy('updated_at','desc');
        return response()->json($user->lastComments);
    }
}

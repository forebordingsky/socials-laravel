<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\Request;

class CommentController extends Controller
{

    public function getAllProfiles()
    {
        $users = User::all();
        return view('home',compact('users'));
    }

    public function profilePage(User $user)
    {
        $user->load('latestComments')->loadCount('userComments');
        return view('profile',compact('user'));
    }

    public function getUserComments(User $user)
    {
        $comments = Comment::where('user_id',$user->id)->with('parent.user')->orderBy('updated_at','desc')->get();
        return view('comments',compact('user','comments'));
    }

    public function addComment(CommentRequest $request, User $user)
    {
        $data = $request->validated();
        $user->comments()->create($data);
        return back()->with('message', 'Success');
    }

    public function replyComment(CommentRequest $request, User $user, Comment $comment)
    {
        $data = $request->validated();
        $comment->replies()->create([
            'header' => $data['header'],
            'description' => $data['description'],
            'user_id' => auth()->user()->id
        ]);
        return back()->with('message', 'Success');
    }

    public function deleteComment(Request $request, User $user, Comment $comment)
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

    public function getAllCommentsJSON(User $user)
    {
        $user->load('lastComments')->orderBy('updated_at','desc');
        return response()->json($user->lastComments);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Возвращает страницу всех пользователей
     *
     * @return void
     */
    public function index()
    {
        $users = User::all();
        return view('home',compact('users'));
    }

    /**
     * Возвращает страницу профиля пользователя с 5 последними комментариями
     *
     * @param User $user
     * @return void
     */
    public function show(User $user)
    {
        $user->load('latestComments')->loadCount('profileComments');
        return view('profile',compact('user'));
    }

    /**
     * При обращении предоставляет или забирает доступ пользователя к библиотеке друого пользователя
     *
     * @param Request $request
     * @param User $user
     * @param User $owner
     * @return void
     */
    public function share(Request $request, User $user, User $owner)
    {
        $owner->sharedUsers()->toggle($user);
        return redirect()->back();
    }
}

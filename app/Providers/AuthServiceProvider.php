<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //Проверка, находится ли авторизованный пользователь на своей странице
        Gate::define('own_profile',function (User $auth, User $user) {
            return $auth->id === $user->id;
        });
        //Проверка на принадлежность комментария пользователю
        Gate::define('own_comment', function (User $user, Comment $comment) {
            return $user->id === $comment->user_id;
        });
    }
}

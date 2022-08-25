<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class,'user_id');
    }

    public function userComments()
    {
        return $this->comments()->where('parent_id',null)->with('user','replies')->orderBy('updated_at','desc');
    }

    public function latestComments()
    {
        return $this->userComments()->limit(5);
    }

    public function lastComments()
    {
        return $this->userComments()->skip(5)->limit(PHP_INT_MAX);
    }

    public function books()
    {
        return $this->hasMany(Book::class,'user_id','id');
    }

    //Пользователи, которым пользователь предоставил доступ
    public function sharedUsers()
    {
        return $this->belongsToMany(User::class,'shared_library','owner_id','user_id');
    }

    //Пользователи, которые предоставили доступ этому пользователю
    public function usersShared()
    {
        return $this->belongsToMany(User::class,'shared_library','user_id','owner_id');
    }
}

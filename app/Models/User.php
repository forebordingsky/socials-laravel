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
        return $this->hasMany(Comment::class,'user_id')->where('parent_id',null)->with('user','replies')->orderBy('updated_at','desc');
    }

    public function onlyComments()
    {
        return $this->hasMany(Comment::class,'user_id')->orderBy('updated_at','desc');
    }

    public function latestComments()
    {
        return $this->comments()->limit(5);
    }

    public function lastComments()
    {
        return $this->comments()->skip(5)->limit(PHP_INT_MAX);
    }
    // public function comments()
    // {
    //     return $this->hasMany(Comment::class,'user_id','id')->where('answered_comment_id',null)->with('user','lastChildren')->orderBy('updated_at','desc');
    // }

    // public function lastComments()
    // {
    //     return $this->comments()->limit(5);
    // }
}

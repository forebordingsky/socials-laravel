<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'content',
        'link_access'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}

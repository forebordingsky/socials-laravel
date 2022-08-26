<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    use HasFactory;

    protected $fillable = [
        'profile_user_id',
        'parent_id',
        'user_id',
        'header',
        'description',
        'deleted'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id')->select('id','email');
    }

    public function replies()
    {
        return $this->hasMany(self::class,'parent_id','id')->with('replies','user')->orderBy('updated_at','desc');
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id', 'id');
    }

    public function getUpdatedAtAttribute($value)
    {
        return (new Carbon($value))->format('l j F, Y h:i:s A');
    }

    public function getHeaderAttribute($value)
    {
        if ($this->deleted) {
            return 'Message deleted';
        }
        return $value;
    }

    public function getDescriptionAttribute($value)
    {
        if ($this->deleted) {
            return 'Message deleted';
        }
        return $value;
    }
}

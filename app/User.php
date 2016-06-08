<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Метод проверки валдения пользователем
     *
     * @param $related
     * @return bool
     */
    public function owns($related)
    {
        return $this->id == $related->user_id;
    }

    /*
    |--------------------------------------------------------------------------
    | Relationship Methods
    |--------------------------------------------------------------------------
    */
    public function post()
    {
        return $this->hasMany('App\Post');
    }

    public function comment()
    {
        return $this->belongsTo('App\Models\Comments\Comment');
    }

    public function commentVote()
    {
        return $this->belongsTo('App\Models\Comments\CommentVote', 'user_id');
    }
}

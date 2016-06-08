<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'user_id',
        'post_id',
        'parent_id',
        'karma',
        'user_ip',
        'content',
        'level',
        'published_at',
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
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function post()
    {
        return $this->belongsToMany('App\Post');
    }

    public function children()
    {
        return $this->hasMany('App\Comment', 'parent_id');
    }

    public function childrenRecursive()
    {
        return $this->children()->with('childrenRecursive');
    }

    public function parent()
    {
        return $this->belongsTo('App\Comment');
    }

    public function parentRecursive()
    {
        return $this->parent()->with('parentRecursive');
    }

}

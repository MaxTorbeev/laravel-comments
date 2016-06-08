<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'intro_text',
        'body',
        'published_at',
        'alias',
        'metakey',
        'metadesc',
        'user_id'
    ];

    protected $dates = ['published_at'];

    /*
    |--------------------------------------------------------------------------
    | Relationship Methods
    |--------------------------------------------------------------------------
    */
    public function commentVote()
    {
        return $this->hasMany('App\Models\Comments\CommentVote');
    }
    /**
     * An post is owned by a user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the comments associated with the give article
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function comment()
    {
        return $this->belongsToMany('App\Models\Comments\Comment', 'comment_post', 'post_id', 'comment_id');
    }

}

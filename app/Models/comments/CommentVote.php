<?php

namespace App\Models\Comments;

use Illuminate\Database\Eloquent\Model;

class CommentVote extends Model
{
    protected $fillable = [
        'comment_id ',
        'user_id ',
        'vote',
    ];

    public function comment()
    {
        $this->belongsTo('App\Models\Comments\Comment', 'comment_id');
    }

    public function user()
    {
        $this->hasMany('App\Models\Comments\Comment', 'user_id');
    }
}

<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function store(Request $request){
        $this->createComment($request);

        return redirect()->route('posts.show', ['id' => $request->post_id]);
    }

    public function createComment(Request $request)
    {
        $post = Post::findOrFail($request->post_id);
        $post->comments()->create($request->all());
    }

    public function vote($id, Request $request)
    {
        $dd = $request->input('vote');
        dd($dd);
    }

    public function delete()
    {

    }

    /**
     * Sync up the list of tags in the database
     *
     * @param Post $article Request $request
     */
    public function c(Post $post, array $tags)
    {
        $post->comments()->sync($tags);
    }
}

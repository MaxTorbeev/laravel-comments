<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Models\Comments\Comment;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    /**
     * @param Post $post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Post $post)
    {
        $posts = $post
            ->orderBy('title', 'desc')
            ->get();

        return view('posts.index', compact('posts'));
    }

    /**
     * Create post page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('posts.create');
    }

    public function store(Post $post, Request $request)
    {
        $this->createItem($post, $request);
        \Session::flash('message', 'Запись создана');

        return redirect()->route('posts.index');
    }

    public function show($id)
    {
        $post = Post::where('id', $id)->firstOrFail();
        $comments = $post->comment()
            ->where('level', '0')
//            ->commentVote
            ->orderBy('vote', 'DESC')
            ->get();

        return view('posts.show', compact('post', 'comments'));
    }

    public function createItem($post, $request)
    {
        $post = Auth::user()->post()->create($request->all());

        return $post;
    }
}

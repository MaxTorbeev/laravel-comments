<?php

namespace App\Http\Controllers;

use App\Models\Comments\Comment;
use App\Models\Comments\CommentVote;
use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommentsController extends Controller
{
    public function store(Request $request)
    {
        $this->createComment($request);

        return redirect()->route('posts.show', ['id' => $request->post_id]);
    }

    public function update($id, Request $request)
    {
        $comment = Comment::findOrFail($id);
        $comment->update($request->all());

        return redirect()->route('posts.show', ['id' => $comment->post()->first()->id]);
    }

    public function vote($id, Request $request, Comment $comment)
    {
        $comment = $comment->where('id', $id)->firstOrFail();
        $commentVote = CommentVote::where('user_id', Auth::user()->id)
            ->where('comment_id', $id)
            ->first();

//        dd($commentVote);
        if ($commentVote != null) {
            switch ($request->input('vote')) {
                case 'true':
                    if ($commentVote->vote == false) {
                        $commentVote->update([
                            'comment_id' => $id,
                            'vote' => 'TRUE'
                        ]);
                        return redirect()->back()->with('message', 'Вы проголосовали положительно!');
                    } else {
                        return redirect()->back()->with('message', 'Вы уже проголосовали положительно!');
                    }
                break;

                case 'false':
                    if ($commentVote->vote == true) {
                        $commentVote->update(['vote' => 'FALSE']);
                        return redirect()->back()->with('message', 'Вы проголосовали отрицательно!');
                    } else {
                        return redirect()->back()->with('message', 'Вы уже проголосовали отрицательно!');
                    }
                break;
            }
        } else {
            $comment->commentVote()->insert([
                'comment_id' => $id,
                'user_id'    => Auth::user()->id,
                'vote'       => $request->input('vote'),
            ]);
            return redirect()->back()->with('message', 'Вы проголосовали впервые!');
        }

        return redirect()->back()->with('message', 'Нужно проголосовать');
    }

    public function destroy($id, Comment $comment)
    {
        $comments = $comment->where('id', $id)->get();
        foreach ($comments as $comment) {
            return $this->_deleteChild($comment);
        }
    }

    public function createComment(Request $request)
    {
        $post = Post::findOrFail($request->post_id);
        $post->comment()->create($request->all());
    }

    private function _deleteChild($comment)
    {
        $comment->where('id', $comment->id)->delete();

        if (count($comment->childrenRecursive) > 0) {
            foreach ($comment->childrenRecursive as $comment) {
                $this->_deleteChild($comment);
                $comment->where('id', $comment->id)->delete();
            }
        }

        return 'comment has been deleted';
    }

}

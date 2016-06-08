<?php

namespace App\Http\Controllers;

use App\Models\Comments\Comment;
use App\Models\Comments\CommentVote;
use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

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
//        $comment->commentVote->update(['vote' => true]);
//        dd($comment->commentVote->vote );
        switch ($request->input('vote')) {
            case 'yes':
                if($comment->commentVote->vote == false or $comment->commentVote->vote == null)
                    $comment->commentVote->update(['vote' => true]);

                return redirect()->back();
                break;
            case 'no':
                if($comment->commentVote->vote == true and $comment->commentVote->vote == null)
                    $comment->commentVote->update(['vote' => false]);

                return redirect()->back();
                break;
        }
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

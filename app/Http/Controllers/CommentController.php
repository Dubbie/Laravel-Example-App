<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request) {
        $data = $request->validate([
            'comment-post-id' => 'required|numeric',
            'comment-message' => 'required'
        ]);

         $comm = new Comment();
         $comm->message = $data['comment-message'];
         $comm->author_id = \Auth::id();
         $comm->post_id = $data['comment-post-id'];
         $comm->save();

        return redirect(action('PostController@show', $data['comment-post-id']))->with([
            'success' => 'Post updated successfully',
        ]);
    }

    /**
     * @param $commentId
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy($commentId) {
        /** @var Comment $comment */
        $comment = \Auth::user()->comments()->find($commentId);
        $postId = $comment->post_id;
        $comment->delete();

        return redirect(action('PostController@show', $postId))->with([
            'success' => 'Comment deleted successfully',
        ]);
    }
}

<?php

namespace App\Http\Controllers\Comments;

use App\Comment;
use Illuminate\Http\Request;
use App\Http\Resources\CommentResource;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function update(Comment $comment, Request $request) {

        \Auth::loginUsingId(1);

        $this->authorize('update', $comment);

        $this->validate($request, [
            'body' => 'required|max:5000'
        ]);

        $comment->update([
            'body' => $request->body
        ]);

        return new CommentResource($comment);
    }
}

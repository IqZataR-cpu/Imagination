<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Publication;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function create(Publication $publication, Request $request)
    {
        $user = \Auth::user();

        if (isset($request->body)) {
            $comment = new Comment();
            $comment->user_id = $user->id;
            $comment->body = $request->body;

            $publication->comments()->save($comment);
        }

        return redirect()->route('welcome');
    }
}
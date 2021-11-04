<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentStoreRequest;
use App\Models\Comment;
use App\Models\Publication;
use App\Models\User;
use App\Repository\CommentRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    private $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function create(CommentStoreRequest $request)
    {
        $model = (new \ReflectionClass($request->commentable_type))->newInstance();
        $model->id = $request->commentable_id;

        $this->commentRepository->store(\Auth::user(), $request->validated(), $model);

        return redirect()->route('welcome');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->route('welcome');
    }
}

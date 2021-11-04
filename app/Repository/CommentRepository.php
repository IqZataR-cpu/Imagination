<?php


namespace App\Repository;


use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class CommentRepository
{
    public function store(User $user, array $data, Model $commentable)
    {
        $comment = new Comment($data);

        $comment->author()->associate($user);
        $comment->fill($data);

        $commentable->comments()->save($comment);

        return $comment;
    }
}

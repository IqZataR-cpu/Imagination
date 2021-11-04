<?php


namespace App\Services;


use App\Models\Dislike;
use App\Models\Like;
use App\Models\Publication;
use App\Models\User;

class PublicationService
{
    public function like(Publication $publication, User $user): ?Like
    {
        Dislike::where([
            ['user_id', $user->id],
            ['publication_id', $publication->id]]
        )->delete();

        if ($publication->hasLike($user)) {
            return null;
        }

        $like = new Like();

        $like->publication()->associate($publication);
        $like->user()->associate($user);
        $like->save();

        return $like;
    }

    public function dislike(Publication $publication, User $user): ?Dislike
    {
        Like::where([
            ['user_id', $user->id],
            ['publication_id', $publication->id]]
        )->delete();

        if ($publication->hasDislike($user)) {
            return null;
        }

        $dislike = new Dislike();

        $dislike->publication()->associate($publication);
        $dislike->user()->associate($user);
        $dislike->save();

        return $dislike;
    }
}

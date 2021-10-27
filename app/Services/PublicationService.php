<?php


namespace App\Services;


use App\Models\Dislike;
use App\Models\Like;
use App\Models\Publication;

class PublicationService
{
    public function liker(Publication $publication, $user_id): Like
    {
        $like = new Like();

        $like->publication_id = $publication->id;
        $like->user_id = $user_id;
        $like->save();

        return $like;
    }

    public function disliker(Publication $publication, $user_id): Dislike
    {
        $dislike = new Dislike();

        $dislike->publication_id = $publication->id;
        $dislike->user_id = $user_id;
        $dislike->save();

        return $dislike;
    }
}

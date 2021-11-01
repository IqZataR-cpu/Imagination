<?php


namespace App\Repository;


use App\Models\Publication;

class PublicationRepository
{
    public function create(array $data)
    {
        $publication = new Publication($data);
        $publication->save();

        return $publication;
    }
}

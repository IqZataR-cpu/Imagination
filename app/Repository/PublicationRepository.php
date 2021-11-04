<?php


namespace App\Repository;


use App\Models\Publication;
use App\Models\User;
use App\Services\ImageService;

class PublicationRepository
{
    /**
     * @var ImageService
     */
    private $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * @param User $user
     * @param array $data
     * @return Publication
     */
    public function create(User $user, array $data): Publication
    {
        $publication = new Publication($data);
        $publication->save();

        $image = $this->imageService->store(
            $data['preview_image'],
            $publication->id,
            'publications'
        );

        $publication->previewImage()->associate($image);

        $publication->author()->associate($user);
        $publication->save();

        return $publication;
    }
}

<?php


namespace App\Services;


use App\Models\Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class ImageService
{
    function store(UploadedFile $uploadedFileImage, int $uniqueId, string $disk): Image
    {
        $image = new Image();

        $fileName = $uniqueId . Str::random('12') . '.' . $uploadedFileImage->clientExtension();
        $uploadedFileImage->storeAs('', $fileName, ['disk' => $disk]);

        $image->path = $fileName;
        $image->disk = $disk;
        $image->save();

        return $image;
    }
}

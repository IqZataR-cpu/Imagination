<?php

namespace App\Http\Controllers;

use App\Http\Requests\PublicationEditRequests;
use App\Http\Requests\PublicationStoreRequests;
use App\Models\Publication;
use App\Services\ImageService;
use Illuminate\Support\Facades\Auth;

class PublicationController extends Controller
{
    private $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function welcome()
    {
        $publications = Publication::all()->random(2);

        return view('welcome', [
            'publications' => $publications
        ]);
    }

    public function index()
    {
        return view('publications.show', [
            'publications' => Auth::user()->publications
        ]);
    }

    public function create()
    {
        return view('publications.create');
    }

    public function store(PublicationStoreRequests $requests)
    {
        $publication = new Publication($requests->validated());
        $publication->save();

        if ($requests->hasFile('preview_image')) {
            $image = $this->imageService->store(
                $requests->file('preview_image'),
                $publication->id,
                'publications'
            );

            $publication->author()->associate($requests->user());
            $publication->previewImage()->associate($image);
            $publication->save();
        }

        return redirect()->route('publication.index');
    }
    public function show(Publication $publication)
    {
        return view('publications.edit', [
            'publication' => Publication::findOrFail($publication->id)
        ]);
    }

    public function edit(Publication $publication, PublicationEditRequests $request)
    {
        $publication->description = $request->description;
        $publication->save();

        return redirect()->route('publication.index');
    }

    public function destroy(Publication $publication)
    {
        $publication->delete();

        return redirect()->route('publication.index');
    }
}

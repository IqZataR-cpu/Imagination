<?php

namespace App\Http\Controllers;

use App\Http\Requests\PublicationEditRequests;
use App\Http\Requests\PublicationStoreRequests;
use App\Models\Dislike;
use App\Models\Like;
use App\Models\Publication;
use App\Models\User;
use App\Services\ImageService;
use App\Services\PublicationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicationController extends Controller
{
    private $imageService;
    private $publicationService;

    public function __construct(ImageService $imageService, PublicationService $publicationService)
    {
        $this->imageService = $imageService;
        $this->publicationService = $publicationService;
    }

    public function welcome()
    {
//        ->random(2)
        $publications = Publication::all();

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

    public function liker(Publication $publication)
    {
        $checkLike = Like::where([
                ['user_id', Auth::user()->id],
                ['publication_id', $publication->id]]
        )->count();

        $checkDislike = Dislike::where([
                ['user_id', Auth::user()->id],
                ['publication_id', $publication->id]]
        )->delete();

        if ($checkLike == null) {
            $like = $this->publicationService->liker($publication, Auth::user()->id);
        }

        return redirect()->route('welcome');
    }

    public function disliker(Publication $publication)
    {
        $check = Dislike::where([
                ['user_id', Auth::user()->id],
                ['publication_id', $publication->id]]
        )->count();

        $checkLike = Like::where([
                ['user_id', Auth::user()->id],
                ['publication_id', $publication->id]]
        )->delete();

        if ($check == null) {
            $like = $this->publicationService->disliker($publication, Auth::user()->id);
        }

        return redirect()->route('welcome');
    }
}

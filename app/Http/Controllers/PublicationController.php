<?php

namespace App\Http\Controllers;

use App\Models\Dislike;
use App\Models\Like;
use App\Http\Requests\PublicationEditRequest;
use App\Http\Requests\PublicationStoreRequest;
use App\Models\Publication;
use App\Services\ImageService;
use App\Services\PublicationService;
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
        $publications = Publication::inRandomOrder()->get();

        return view('welcome', [
            'publications' => $publications
        ]);
    }

    public function index()
    {
        return view('publications.index', [
            'publications' => Auth::user()->publications,
            'comment'
        ]);
    }

    public function create()
    {
        return view('publications.create');
    }

    public function store(PublicationStoreRequest $request)
    {
        // fixme Вынести логику в Repository -> PublicationRepository, method store,
        //  главное условие, не передавать request в метод репозитория
        $publication = new Publication($request->validated());
        $publication->save();

        $image = $this->imageService->store(
            $request->file('preview_image'),
            $publication->id,
            'publications'
        );

        $publication->previewImage()->associate($image);

        $publication->author()->associate($request->user());
        $publication->save();

        return redirect()->route('publication.index');
    }
    public function show(Publication $publication)
    {
        return view('publications.edit', [
            'publication' => Publication::findOrFail($publication->id)
        ]);
    }

    public function edit(Publication $publication, PublicationEditRequest $request)
    {
        $publication->fill($request->validated());
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
        $like = $this->publicationService->liker($publication, Auth::user()->id);

        return redirect()->route('welcome');
    }

    public function disliker(Publication $publication)
    {
        $dislike = $this->publicationService->disliker($publication, Auth::user()->id);

        return redirect()->route('welcome');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\PublicationEditRequest;
use App\Http\Requests\PublicationStoreRequest;
use App\Models\Publication;
use App\Repository\PublicationRepository;
use App\Services\PublicationService;
use Illuminate\Support\Facades\Auth;

class PublicationController extends Controller
{
    private $publicationService;
    private $publicationRepository;

    public function __construct(
        PublicationService $publicationService,
        PublicationRepository $publicationRepository
    ) {
        $this->publicationService = $publicationService;
        $this->publicationRepository = $publicationRepository;
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
        $this->publicationRepository->create($request->user(), $request->validated());

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
        $publication->fill($request->validated())->save();

        return redirect()->route('publication.index');
    }

    public function destroy(Publication $publication)
    {
        $publication->delete();

        return redirect()->route('publication.index');
    }

    public function like(Publication $publication)
    {
        $this->publicationService->like($publication, Auth::user());

        return redirect()->route('welcome');
    }

    public function dislike(Publication $publication)
    {
        $this->publicationService->dislike($publication, Auth::user());

        return redirect()->route('welcome');
    }
}

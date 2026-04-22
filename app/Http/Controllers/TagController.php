<?php

namespace App\Http\Controllers;

use App\BlogApp\TagRepositoryInterface;
use App\Events\BlogDataSavedInDbEvent;
use App\Http\Requests\SaveTagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class TagController extends Controller implements HasMiddleware
{
    public function __construct(public TagRepositoryInterface $tagRepository)
    {

    }

    public static function middleware(): array
    {
        return [
            new Middleware('auth', except: ['index', 'show'])
        ];
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard-add-tag');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SaveTagRequest $request)
    {
        $validated = $request->validated();
        $this->tagRepository->createTag($validated);
        return redirect('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        return view('dashboard-edit-tag', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SaveTagRequest $request, Tag $tag)
    {
        $validated = $request->validated();
        $this->tagRepository->updateTag($validated, $tag);
        BlogDataSavedInDbEvent::dispatch();
        return redirect('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $this->tagRepository->deleteTag($tag);
        BlogDataSavedInDbEvent::dispatch();
        return redirect()->back();
    }
}

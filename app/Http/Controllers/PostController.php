<?php

namespace App\Http\Controllers;

use App\BlogApp\PostRepositoryInterface;
use App\BlogApp\TagRepositoryInterface;
use App\Events\BlogDataSavedInDbEvent;
use App\Http\Requests\SavePostRequest;
use App\Models\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class PostController extends Controller implements HasMiddleware
{
    use AuthorizesRequests;

    public function __construct(public PostRepositoryInterface $postRepository)
    {

    }
    
    public static function middleware(): array
    {
        return [
            new Middleware('auth', except: ['index', 'show'])
        ];
    }

    public function mainDashboard(PostRepositoryInterface $postRepository, TagRepositoryInterface $tagRepository)
    {
        $posts = $postRepository->getAllPosts();
        $tags = $tagRepository->getAllTags();
        return view('dashboard', compact('posts', 'tags'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $tag = null)
    {
        if ($request->is('posts/tag/*')) {
            $posts = $this->postRepository->getTaggedPosts($tag);
        } else {
            $posts = $this->postRepository->getAllPosts();
        }
        return view('blog-frontend.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(TagRepositoryInterface $tagRepository)
    {
        return view('dashboard-add-post', ['tags' => $tagRepository->getAllTags()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SavePostRequest $request)
    {
        $validated = $request->validated();
        $this->postRepository->createPost($validated);
        BlogDataSavedInDbEvent::dispatch();
        return redirect('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $title_slug)
    {
        $post = $this->postRepository->findOneByTitleSlug($title_slug);
        return view('blog-frontend.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TagRepositoryInterface $tagRepository,Post $post )
    {
        $this->authorize('update-delete-post', $post);
        return view('dashboard-edit-post', [
            'post' => $post, 'tags' => $tagRepository->getAllTags()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SavePostRequest $request, Post $post)
    {
        $validated = $request->validated();
        $this->postRepository->updatePost($validated, $post);
        BlogDataSavedInDbEvent::dispatch();
        return redirect('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('update-delete-post', $post);
        $this->postRepository->deletePost($post);
        BlogDataSavedInDbEvent::dispatch();
        return redirect()->back();
    }
}

<?php

namespace App\BlogApp;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class PostRepository implements PostRepositoryInterface
{
    public function getAllPosts()
    {
        $cacheKey = url()->full();
        $sort =  request()->query('sort', false);

        return Cache::rememberForever($cacheKey, function () use ($sort) {

            return Post::with('user')->when($sort, function ($query, $sort) {
                $query->orderBy('created_at', $sort);
            })->paginate(5)->withQueryString();
        });

    }

    public function findOneByTitleSlug(string $title_slug)
    {
        return Cache::rememberForever(url()->full(), function () use ($title_slug) {
            return Post::where('slug', $title_slug)->first();
        });
    }

    public function searchPosts($search_term)
    {
        return Post::whereRaw("match (title) against ('\"$search_term\"' in boolean mode)")->orWhereRaw("match (content) against ('\"$search_term\"' in boolean mode)")->get();
        // https://dev.mysql.com/doc/refman/8.0/en/fulltext-boolean.html

        // PostgreSQL:
        //     return Post::whereRaw("to_tsvector('english', title) @@ to_tsquery('english', ?)", [$search_term])
        // ->orWhereRaw("to_tsvector('english', content) @@ to_tsquery('english', ?)", [$search_term])
        // ->get();

        // return Post::where('title', 'like', "%$search_term%")->orWhere('content', 'like', "%$search_term%")->get();

        // return Post::whereFullText('title', $search_term)->orWhereFullText('content', $search_term)->get();
    }

    public function getTaggedPosts($tag)
    {
        $sort =  request()->query('sort', false);
        $cacheKey = url()->full();
        return Cache::rememberForever($cacheKey, function () use ($sort, $tag) {
            return Post::with('user')
            ->whereHas('tags', function ($query) use ($tag) {
                $query->where('name', $tag);
            })->when($sort, function ($query, $sort) {
                $query->orderBy('created_at', $sort);
            })
            ->paginate(5)->withQueryString();
        });
    }

    public function createPost($validated)
    {
        $post = new Post();
        $post->slug = Str::slug($validated['title'], '-');
        $post->title = $validated['title'];
        $post->content = $validated['content'];
        $post->user_id = Auth::user()->id;
        $post->save();
        $post->tags()->sync($validated['tag'] ?? []);
    }

    public function updatePost($validated, $post)
    {
        $post->tags()->sync($validated['tag'] ?? []);
        $post->title = $validated['title'];
        $post->content = $validated['content'];
        $post->save();
    }

    public function deletePost($post)
    {
        $post->delete();
    }
}
<?php
namespace App\BlogApp;

use App\Models\Tag;

class TagRepository implements TagRepositoryInterface
{
    public function getAllTags()
    {
        return Tag::orderBy('name')->get();
    }

    public function createTag($validated)
    {
        $tag = new Tag();
        $tag->name = $validated['tag'];
        $tag->save();
    }

    public function updateTag($validated, $tag)
    {
        $tag->name = $validated['tag'];
        $tag->update();
    }

    public function deleteTag($tag)
    {
        $tag->delete();
    }
}
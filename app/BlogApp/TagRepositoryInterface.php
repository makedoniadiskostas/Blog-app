<?php
namespace App\BlogApp;

interface TagRepositoryInterface
{
    public function getAllTags();
    public function createTag($validated);
    public function updateTag($validated, $tag);
    public function deleteTag($tag);
}
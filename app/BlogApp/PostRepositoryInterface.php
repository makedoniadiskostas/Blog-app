<?php

namespace App\BlogApp;

interface PostRepositoryInterface
{
    public function getAllPosts();
    public function getTaggedPosts($tag);
    public function findOneByTitleSlug(string $title_slug);
    public function createPost($validated);
    public function updatePost($validated, $post);
    public function searchPosts($search_term);
    public function deletePost($post);
}
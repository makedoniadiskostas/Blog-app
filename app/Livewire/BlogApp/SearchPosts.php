<?php

namespace App\Livewire\BlogApp;

use App\BlogApp\PostRepositoryInterface;
use Livewire\Component;

class SearchPosts extends Component
{
    public $search = '';
    protected $postRepository;

    public function boot(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function render()
    {
        return view('livewire.blog-app.search-posts', [
            'posts' => $this->search ? $this->postRepository->searchPosts($this->search) : [],
        ]);
    }
}

<?php

namespace App\Providers;

use App\BlogApp\PostRepository;
use App\BlogApp\PostRepositoryInterface;
use App\BlogApp\TagRepository;
use App\BlogApp\TagRepositoryInterface;
use Illuminate\Routing\UrlGenerator; // __DEPLOY__
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View as ViewClosureBased;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
        $this->app->bind(TagRepositoryInterface::class, TagRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(UrlGenerator $url): void
    {
        View::composer(['components.layouts.blog-layout'], function (ViewClosureBased $view): void {
            $tagsRepo = $this->app->make(TagRepository::class);
            $tags = $tagsRepo->getAllTags();
            $view->with('tags', $tags);
        });

        Gate::define('update-delete-post', function (User $user, Post $post) {
            return $user->id === $post->user_id;
        });

        if (env('APP_ENV') == 'production') { // __DEPLOY__
            $url->forceScheme('https');
        }
    }
}

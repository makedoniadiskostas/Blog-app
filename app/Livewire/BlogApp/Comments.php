<?php

namespace App\Livewire\BlogApp;

use App\Events\BlogDataSavedInDbEvent;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Comments extends Component
{
    public $addedComment = '';
    public $post;
    public $likedOrDisliked = [];
    public $currentUrl;

    public function render()
    {
        return view('livewire.blog-app.comments');
    }

    public function mount()
    {
        $this->currentUrl = url()->full();
    }

    public function rules()
    {
        return [
            'addedComment' => 'required|min:10|max:500',
        ];
    }

    public function addComment()
    {
        if (!Auth::check()) {
            $this->addedComment = 'you should be logged in to add a comment or like/dislike';
            return;
        }
        $this->validate();
        $this->post->comments()->create(['body' => $this->addedComment, 'user_id' => Auth::user()->id]);
        BlogDataSavedInDbEvent::dispatch($this->currentUrl);
        $this->addedComment = '';
    }

    public function like($comment_id)
    {
        if (!Auth::check()) return;

        if(isset($_COOKIE['comment_liked_' . $comment_id]) || isset($_COOKIE['comment_disliked_' . $comment_id])) {
            if (!isset($likedOrDisliked[$comment_id])) {
                $likedOrDisliked[$comment_id] = 'block';
            }
            $this->dispatch('alreadyLikedDisliked', $comment_id); // listener in comments.blade
        } else {
            Comment::where('id', $comment_id)->increment('likes');
            BlogDataSavedInDbEvent::dispatch($this->currentUrl);
            setcookie('comment_liked_' . $comment_id, $comment_id, time() + 3600 * 24 * 365, '/');
        }

    }

    public function dislike($comment_id)
    {
        if (!Auth::check()) return;
        if (isset($_COOKIE['comment_liked_' . $comment_id]) || isset($_COOKIE['comment_disliked_' . $comment_id])) {
            if (!isset($likedOrDisliked[$comment_id])) {
                $likedOrDisliked[$comment_id] = 1;
            }
            $this->dispatch('alreadyLikedDisliked', $comment_id); // listener in comments.blade
        } else {
            Comment::where('id', $comment_id)->increment('dislikes');
            BlogDataSavedInDbEvent::dispatch($this->currentUrl);
            setcookie('comment_disliked_' . $comment_id, $comment_id, time() + 3600 * 24 * 365, '/');
        }

    }
}

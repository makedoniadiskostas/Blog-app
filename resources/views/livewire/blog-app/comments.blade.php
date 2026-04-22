<div x-data="{show:false}">
    <p class="text-blue-500 hover:text-blue-600 font-bold cursor-pointer">
        <a wire:key="1a" x-show="show===false" x-on:click="show=!show">See comments ({{ $commentCount = $post->comments()->count() }})</a>
        <a wire:key="2a" x-show="show===true" x-on:click="show=!show">Hide comments ({{ $commentCount }})</a>
    </p>
    <div x-show="show" class="ml-5" x-transition>
        <h3 class="text-xl font-bold mb-2 mt-2 dark:text-slate-400">Comments</h3>
        <ul class="space-y-5 text-gray-500 dark:text-slate-400">
            @foreach($post->comments()->with('user')->get() as $comment)
            <li wire:key="{{ $comment->id }}" class="flex items-center mb-3 border-b dark:border-slate-400">
                <p>{{ $comment->body }}
                    <span class="text-sm italic font-bold">by {{ $comment->user->name }}</span>
                    <span wire:click="like({{$comment->id}})" class="cursor-pointer" title="like it">&#128077;</span><span class="">{{ $comment->likes }}</span>
                    <span wire:click="dislike({{$comment->id}})" class="cursor-pointer" title="dislike it">&#128078;</span><span class="">{{ $comment->dislikes }}</span><span id="comment-{{$comment->id}}" wire:ignore class="hidden p-4 mb-4 text-base leading-5 text-white bg-red-500 rounded-lg opacity-100 font-regular">
                        You already like or dislike this comment
                    </span>
                </p>
            </li>

            @endforeach
        </ul>
        @error('addedComment') <span class="text-red-600 block">{{ $message }}</span>@enderror
        @error('login') <span class="text-red-600 block">{{ $message }}</span>@enderror
        <textarea class="dark:bg-slate-800 dark:text-slate-400" wire:model="addedComment" rows="4" cols="50" placeholder="add a comment"></textarea>
        <button wire:click="addComment" class="block bg-blue-500 hover:bg-blue-700 text-white p-2">Add Comment</button>
    </div>
</div>

@script
<script>
Livewire.on('alreadyLikedDisliked', (comment_id) => {
    $wire.$el.querySelector('#comment-' + comment_id[0]).classList.remove("hidden");
    $wire.$el.querySelector('#comment-' + comment_id[0]).classList.add("inline-block");
    setTimeout(function() {
            $wire.$el.querySelector('#comment-' + comment_id[0]).classList.add("hidden");
            $wire.$el.querySelector('#comment-' + comment_id[0]).classList.remove("inline-block");
        }, 3000)
})
</script>
@endscript
<div>
    <input type="text" placeholder="search posts ..." class="w-full dark:bg-slate-800 dark:text-slate-400" wire:model.live="search">
    <ul class="bg-white border dark:text-slate-400 dark:bg-slate-800 border-slate-100 dark:border-slate-500 mt-2">
        @foreach($posts as $post)
        <li class="pl-8 pr-2 py-1 border-b-2 border-slate-100 dark:border-slate-500 relative hover:bg-yellow-50 hover:text-gray-700 dark:hover:text-gray-800 dark:hover:bg-slate-400">
            <a href="{{ route('posts.show', [$post->slug]) }}">{{ $post->title }}</a>
        </li>
        @endforeach
    </ul>
</div>
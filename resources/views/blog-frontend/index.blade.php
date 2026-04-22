<x-layouts.blog-layout>
    <x-slot:title>
    List of blog posts
    </x-slot:title>
    <!-- articles -->
    <div class="w-4/5 space-y-20">

        @foreach($posts as $post)
        <div class="flex flex-col space-y-3 px-5 md:px-20">
            <div>
                <span class="text-slate-500 italic">{{ $post->created_at->format('Y-m-d') }}, by {{ $post->user->name }}</span> | <span class="text-blue-600">{{ $post->timeToRead }} MIN READ</span>
            </div>
            <article class="space-y-3">
                <h1 class="text-4xl dark:text-slate-400" style="font-family: 'Archivo Black', sans-serif;">{{ $post->title }}</h1>
                <p class="text-gray-600 dark:text-slate-400">
                    {{ \Illuminate\Support\Str::limit(strip_tags($post->content), 500, ' (...)') }}
                </p>
            </article>
            <p class="text-blue-600 font-bold"><a href="{{ route('posts.show', [$post->slug]) }}">Read more ></a></p>
        </div>
        @endforeach

        <!-- pagination -->
        <div class="p-6">
            {{ $posts->links() }}
        </div>
        

    </div>
</x-layouts.blog-layout>
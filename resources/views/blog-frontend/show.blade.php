<x-layouts.blog-layout>
    <x-slot:title>
        Particular post
    </x-slot:title>
    <!-- article -->
    <div class="w-4/5 space-y-20">
        <div class="flex flex-col space-y-3 px-5 md:px-20">
            <div>
                <span class="text-gray-500 italic">{{ $post->created_at->format('Y-m-d') }}, by {{ $post->user->name }}</span> | <span class="text-blue-600">{{ $post->timeToRead }} MIN READ</span>
            </div>
            <article class="space-y-3">
                <h1 class="text-4xl dark:text-slate-400" style="font-family: 'Archivo Black', sans-serif;">{{ $post->title }}</h1>
                <p class="leading-loose text-gray-600 dark:text-slate-400">
                    {!! $post->content !!}
                </p>
            </article>
            <livewire:blog-app.comments :post="$post"/>

            <div class="md:h-24"></div>
        </div>
    </div>

</x-layouts.blog-layout>
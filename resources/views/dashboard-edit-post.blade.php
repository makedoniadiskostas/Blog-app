<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-5">
                <div class="p-6 text-gray-900">

                    <h2 class="text-2xl font-semibold mb-6">Edit Post</h2>
                    <div class="w-1/2">

                        <form action="{{ route('posts.update', [$post->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                @error('title')<b class="text-red-600">{{ $message }}</b>@enderror
                                <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title</label>
                                <input type="text" id="title" name="title" placeholder="Post title" value="{{ old('title', $post->title) }}" required class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500">
                            </div>
                            <div class="mb-4">
                                @error('content')<b class="text-red-600">{{ $message }}</b>@enderror
                                <label for="content" class="block text-gray-700 text-sm font-bold mb-2">Content</label>
                                <textarea rows="7" id="content" name="content" placeholder="Post content" required class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500">{{ old('content', $post->content) }}</textarea>
                            </div>
                            <div class="mb-4">
                                Tags
                                @error('tag.0')<b class="text-red-600">{{ $message }}</b>@enderror
                                <div class="flex flex-wrap">
                                    @foreach($tags as $tag)
                                    <div class="mr-8">
                                        <input name="tag[]" @checked(in_array($tag->name, $post->tags->pluck('name')->toArray())) id="checkbox-{{$tag->id}}" type="checkbox" value="{{ $tag->id }}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                        <label for="checkbox-{{$tag->id}}" class="ms-2 text-sm font-medium text-gray-900 uppercase">{{ $tag->name }}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue">
                                Update Post
                            </button>
                        </form>
                    </div>

                </div>
            </div>


        </div>
    </div>
    @include('blog-frontend._tinymce')
</x-layouts.app>
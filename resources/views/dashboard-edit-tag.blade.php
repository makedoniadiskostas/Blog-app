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

                    <h2 class="text-2xl font-semibold mb-6">Edit Tag</h2>
                    <div class="w-1/2">

                        
                        <form action="{{ route('tags.update', [$tag->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                @error('tag')<b class="text-red-600">{{ $message }}</b>@enderror
                                <label for="tag" class="block text-gray-700 text-sm font-bold mb-2">Tag</label>
                                <input type="text" id="tag" name="tag" value="{{ old('tag', $tag->name) }}" required class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500">
                            </div>
                     
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue">
                                Update Tag
                            </button>
                        </form>
                    </div>

                </div>
            </div>


        </div>
    </div>
</x-layouts.app>
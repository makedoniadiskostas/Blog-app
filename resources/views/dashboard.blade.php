<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        {{-- <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            </div>
        </div> --}}
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            {{-- <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" /> --}}
        <!-- posts list -->
            <div class="overflow-x-auto shadow-md">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                        <tr>
                            <th class="px-6 py-3">
                                Blog Post Title
                            </th>
                            <th class="px-6 py-3">
                                Description
                            </th>
                            <th class="px-6 py-3">
                                Author
                            </th>
                            <th class="px-6 py-3">
                                Date
                            </th>
                            <th class="px-6 py-3 text-right">
                                <a href="{{ route('posts.create') }}" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg px-6 py-3 inline-block">Add Post</a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                        <tr class="bg-white border-b hover:bg-blue-50">
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $post->title }}
                            </td>
                            <td class="px-6 py-4 text-gray-900 whitespace-nowrap">
                                {{ \Illuminate\Support\Str::limit(strip_tags($post->content), 20, ' (...)') }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $post->user->name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $post->created_at }}
                            </td>
                            <td class="px-6 py-4 text-right">
                        @can('update-delete-post', $post)
                                <a href="{{ route('posts.edit',[$post->id]) }}" class="font-medium text-blue-600 hover:underline">Edit</a> /
                                <form action="{{ route('posts.destroy',[$post->id]) }}" class="inline" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Do you want to delete?')" type="submit" class="font-medium text-red-600 hover:underline">Delete</button>
                                </form>
                            @endcan

                            </td>
                        </tr>
                        @endforeach
            
                    </tbody>
                </table>
            </div>
            <!-- posts pagination -->
            <div class="pt-4"></div>
            {{ $posts->links() }}
        </div>
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            {{-- <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" /> --}}
            <!-- dashboard section tags -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-5">
                <div class="p-6">

                    <!-- tags list -->
                    <div class="overflow-x-auto shadow-md">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                                <tr>
                                    <th class="px-6 py-3">
                                        Tag
                                    </th>
                                    <th class="px-6 py-3">
                                        Date
                                    </th>
                                    <th class="px-6 py-3 text-right">
                                        <a href="{{ route('tags.create') }}" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg px-6 py-3 inline-block">Add Tag</a>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tags as $tag)
                                <tr class="bg-white border-b hover:bg-blue-50">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        {{ $tag->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                      {{ $tag->created_at }}
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <a href="{{ route('tags.edit', [$tag->id]) }}" class="font-medium text-blue-600 hover:underline">Edit</a> / 
                                        <form action="{{ route('tags.destroy', [$tag->id]) }}" class="inline" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Do you want to delete?')" type="submit" class="font-medium text-red-600 hover:underline">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                     
                            </tbody>
                        </table>
                    </div>

                    
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>

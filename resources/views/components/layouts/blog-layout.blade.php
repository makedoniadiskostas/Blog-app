<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Laravel Blog' }}</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo+Black&display=swap" rel="stylesheet">
    <script>
        var url = '{{ request()->routeIs("posts.tagged") ? route("posts.tagged", ["tag" => request("tag")]) : (request()->routeIs("posts.index") ? route("posts.index") : null) }}';
    </script>
</head>

<body>
    <div class="h-screen flex flex-col font-sans dark:bg-slate-900">

        <!-- header -->
        <header
            class="flex flex-col justify-center items-center h-14 lg:h-36 bg-gradient-to-r from-blue-500 to-blue-400 dark:from-slate-800 dark:to-slate-700 p-4 text-white dark:text-slate-300">
            <h1 class="font-extrabold text-4xl tracking-tight">My Awesome Blog</h1>
            <div class="border-rose-600 bg-gradient-to-r from-pink-500 to-yellow-500 font-extrabold p-1">Laravel Course
                App</div>
        </header>

        <!-- auth links -->
        <div class="p-3 float-right flex justify-end text-slate-600 dark:text-slate-400">
            @include('blog-frontend._switch-theme-button')
            <a href="{{ url('/') }}"
                class="mr-3 font-semibold hover:text-slate-900 dark:hover:text-slate-600 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Main Page</a>

            @auth
            <a href="{{ url('/dashboard') }}"
                class="font-semibold hover:text-slate-900 dark:hover:text-slate-600 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                wire:navigate>Dashboard</a>
            @else
            <a href="{{ route('login') }}"
                class="font-semibold hover:text-slate-900 dark:hover:text-slate-600 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                wire:navigate>Log in</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}"
                class="ms-4 font-semibold hover:text-slate-900 dark:hover:text-slate-600 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                wire:navigate>Register</a>
            @endif
            @endauth
        </div>

        <!-- content -->
        <div class="flex flex-1 flex-col md:flex-row xl:overflow-auto p-4 md:p-20">
            {{ $slot }}
            <!-- side bar right: search, tags -->
            <div class="w-full md:w-1/5 mt-5 md:mt-0 flex flex-col space-y-4">

                <livewire:blog-app.search-posts />
                <select class="dark:bg-slate-800 dark:text-slate-400"
                    onchange="location.href = url + '/?sort='+this.value">
                    <option @selected(!isset(request()->sort)) disabled value="0">--Sort posts--</option>
                    <option @selected(request()->sort === 'desc') value="desc">Newer first</option>
                    <option @selected(request()->sort === 'asc') value="asc">Older first</option>
                </select>

                <div class="flex flex-col space-y-2">
                    <span class="text-3xl font-bold dark:text-slate-400">Tags</span>
                    <div class="flex flex-wrap space-y-2 text-white font-bold">

                        @foreach($tags as $tag)
                        @if(request()->route('tag') == $tag->name)
                        <a href="{{ route('posts.tagged', [$tag->name]) }}"
                            class="border-rose-600 bg-gradient-to-r from-pink-500 to-yellow-500 hover:from-green-400 hover:to-blue-500 p-2 mx-2">{{
                            $tag->name }}</a>
                        @else
                        <a href="{{ route('posts.tagged', [$tag->name]) }}"
                            class="border-rose-600 bg-gradient-to-r from-green-400 to-blue-500 hover:from-pink-500 hover:to-yellow-500 p-2 mx-2">{{
                            $tag->name }}</a>
                        @endif
                        @endforeach

                    </div>
                </div>
            </div>
        </div>

        <!-- footer -->
        <footer
            class="flex lg:h-20 h-10 border-t-[1px] dark:border-slate-500 justify-center md:p-3 p-1 dark:text-slate-400">
            &copy; 2025 All Rights Reserved
        </footer>

    </div>
    @livewireScripts

</body>

</html>
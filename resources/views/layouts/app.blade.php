<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf_token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name'))</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <!-- AlpineJS CDN -->
    <script
        defer
        src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link
        rel="preconnect"
        href="https://fonts.googleapis.com"/>
    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin/>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap"
        rel="stylesheet"/>

    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        [x-cloak] {
            display: none
        }
    </style>
</head>

<body class="bg-gray-100" x-cloak x-data="{openModal: false}"
      :class="openModal ? 'overflow-hidden' : 'overflow-visible'">
<header>
    @include('layouts.navigation')
</header>

<main
    class="container max-w-xl mx-auto space-y-8 mt-8 px-2 md:px-0 min-h-screen">
    @yield('content')
</main>

<footer class="shadow bg-black mt-10">
    <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
        <div class="sm:flex sm:items-center sm:justify-between">
            <a href="#" class="flex items-center mb-4 sm:mb-0">
                    <span class="self-center text-2xl font-semibold whitespace-nowrap text-white">
                        Barta
                    </span>
            </a>
            <ul
                class="flex flex-wrap items-center mb-6 text-sm font-medium sm:mb-0 text-gray-100">
                <li>
                    <a href="#" class="mr-4 hover:underline md:mr-6">About</a>
                </li>
                <li>
                    <a href="#" class="mr-4 hover:underline md:mr-6">Privacy Policy</a>
                </li>
                <li>
                    <a href="#" class="mr-4 hover:underline md:mr-6">Licensing</a>
                </li>
                <li>
                    <a href="#" class="hover:underline">Contact</a>
                </li>
            </ul>
        </div>
        <hr class="my-6 sm:mx-auto border-gray-700 lg:my-8"/>
        <span class="block text-sm sm:text-center text-gray-200">© 2023
                <a href="https://github.com/alnahian2003" class="hover:underline">Barta</a>. All Rights Reserved.
        </span>
    </div>
</footer>

@include('layouts.scripts.user-search')

@yield('script')

</body>
</html>

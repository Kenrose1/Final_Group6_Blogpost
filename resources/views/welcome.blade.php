<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="antialiased bg-white dark:bg-gray-900 bg-cover bg-center bg-fixed"
    style="background-image: url('{{ asset('images/background.jfif') }}')">
    <div class="relative min-h-screen flex flex-col items-center justify-center">
        <!-- Overlay -->
        <div class="absolute inset-0 bg-black opacity-50"></div>

        <header class="w-full absolute top-0 z-10">
            <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
                <a href="/" class="text-2xl font-bold text-white">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <div>
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('Blogpost') }}"
                                class="px-4 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded-lg">Contents</a>
                        @else
                            <a href="{{ route('login') }}"
                                class="text-white hover:text-gray-300 mr-4">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="px-4 py-2 text-white bg-green-500 hover:bg-green-600 rounded-lg">Register</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </nav>
        </header>

        <main class="relative z-10 flex flex-col items-center text-center text-white px-6">
            <div class="w-48 h-48 mb-8 rounded-full overflow-hidden shadow-2xl border-4 border-white dark:border-gray-700">
                <img src="{{ asset('images/homeblog.png') }}" alt="Hero image" class="w-full h-full object-cover"
                    onerror="this.onerror=null; this.src='https://placehold.co/200x200/94a3b8/ffffff?text=Hero'">
            </div>
            <h1 class="text-5xl md:text-6xl font-extrabold leading-tight mb-4 drop-shadow-lg">
                Welcome to our Awesome Blog
            </h1>
            <p class="text-lg md:text-xl text-gray-200 max-w-2xl mb-8 drop-shadow-md">
                Discover our amazing post about anything that is a trend or a freedom wall for anyone to use freely!
</p>
        </main>

        <footer class="w-full absolute bottom-0 py-4 z-10">
            <div class="container mx-auto text-center text-gray-400">
                &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.
            </div>
        </footer>
    </div>
</body>

</html>

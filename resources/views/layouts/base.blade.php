<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <livewire:styles />
    <script defer src="{{ asset('vendor/kustomer/js/kustomer.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/progressbar.js/1.1.0/progressbar.min.js"
        integrity="sha512-EZhmSl/hiKyEHklogkakFnSYa5mWsLmTC4ZfvVzhqYNLPbXKAXsjUYRf2O9OlzQN33H0xBVfGSEIUeqt9astHQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script defer src="https://unpkg.com/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .kustomer-popup {
            background-color: rgb(17, 28, 54) !important;
        }
    </style>

</head>

<body class="bg-gray-900 text-white">
    <header class="border-b border-gray-800">
        <nav class="container mx-auto flex flex-col lg:flex-row items-center justify-between px-4 py-6">
            <div class="flex flex-col lg:flex-row items-center">
                <a href="{{ route('game.index') }}">
                    <img src="{{ asset('logo.svg') }}" alt="Logo" class="w-16 flex-none">
                </a>
                <ul class="flex ml-0 lg:ml-16 space-x-8 mt-6 lg:mt-0">
                    <li><a href="#" class="hover:text-gray-400">Games</a></li>
                    <li><a href="#" class="hover:text-gray-400">Reviews</a></li>
                    <li><a href="#" class="hover:text-gray-400">Coming Soon</a></li>
                </ul>
            </div>
            <div class="flex items-center mt-6 lg:mt-0">
                <livewire:search-dropdown>
                    <div class="ml-6">
                        <a href="#"><img src="/avatar.jpg" alt="avatar" class="rounded-full w-8"></a>
                    </div>
            </div>
        </nav>
    </header>

    <main class="py-8">
        {{ $slot }}
    </main>

    <footer class="border-t border-gray-800">
        <div class="container mx-auto px-4 py-6 text-center">
            Powered By &copy;<a href="" class="underline hover:text-gray-400">AlpetG</a>
        </div>
    </footer>

    @include('kustomer::kustomer')

    <livewire:scripts />
    @stack('scripts')

</body>

</html>

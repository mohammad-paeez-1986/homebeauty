<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? config('app.name') }}</title>
    <link rel="icon" type="image" href="{{ asset('images/favicon.png') }}">
     @stack('meta')

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>

<body class="text-gray-800 antialiased">

    <div class="min-h-screen flex flex-col">
        <livewire:header />

        @yield('hero')

        <main class="mx-auto px-4 sm:px-5 py-5 md:py-6 flex-1">
            @yield('content')
            {{ $slot ?? '' }}
        </main>

        <x-footer />
        <x-toast />
    </div>

    @livewireScripts
</body>

</html>

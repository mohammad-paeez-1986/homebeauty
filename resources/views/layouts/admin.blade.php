<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

</head>

<body class="text-gray-800">
    <div class="text-center p-6  text-gray-600 ">Admin Dashborad</div>
    
    <x-admin.sidebar >
        {{ $slot }}
    </x-admin.sidebar>

    <x-toast />
    @livewireScripts
</body>

</html>

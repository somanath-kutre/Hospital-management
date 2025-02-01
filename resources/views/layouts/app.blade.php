<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- <link rel="stylesheet" href="{{asset('build/assets/app-efa4fe40.css')}}"> --}}
    <link rel="stylesheet" href="{{ asset('build/assets/app-e0c58a55.css') }}">


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])


    <script src="{{ asset('js/flowbite.min.js') }}"></script>
    <script src="{{ asset('js/jQuery.js') }}"></script>

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased dark:bg-gray-600">
    @include('sweetalert::alert')

<x-res-navbar />

    @switch(Auth::user()->user_type)

        @case(777)
        <x-admin_sidebar />
            @break
        @case(755)
        <x-res-sidebar />
            @break
        @default    
    @endswitch
    {{-- <x-res-sidebar /> --}}

    <div class="p-4 sm:ml-64 dark:bg-gray-600">
        <div class="border-2 border-gray-200 lg:p-4 rounded-lg dark:bg-gray-600 dark:border-gray-700 mt-14">
             {{ $slot }}
        </div>
    </div>
</body>
</html>

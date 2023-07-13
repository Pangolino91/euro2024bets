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

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            @if(session('success'))
                <div class="max-w-7xl mx-auto mt-2 sm:px-6 lg:px-8">
                    <div class=" bg-green-700 text-white text-sm rounded-lg font-bold p-3">
                        {{ session('success') }}
                    </div>
                </div>
            @endif
            @if(session('error'))
                <div class="max-w-7xl mx-auto mt-2 sm:px-6 lg:px-8">
                    <div class=" bg-red-700 text-white text-sm rounded-lg font-bold p-3">
                        {{ session('error') }}
                    </div>
                </div>
            @endif
            @if(session('warning'))
                <div class="max-w-7xl mx-auto mt-2 sm:px-6 lg:px-8">
                    <div class=" bg-yellow-700 text-white text-sm rounded-lg font-bold p-3">
                        {{ session('warning') }}
                    </div>
                </div>
            @endif
            @if(session('info'))
                <div class="max-w-7xl mx-auto mt-2 sm:px-6 lg:px-8">
                    <div class=" bg-blue-700 text-white text-sm rounded-lg font-bold p-3">
                        {{ session('info') }}
                    </div>
                </div>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>

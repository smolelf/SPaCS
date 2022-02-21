<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SPaCS') }}</title>

        <link rel="icon" type="image/x-icon" href="{{url('/img/favicon.svg')}}">

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="flex justify-between sm:justify-between max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Heading(Search) -->
            @if (isset($searchtitle))
                <header class="bg-white shadow">
                    <div class="flex justify-between sm:justify-between max-w-7xl mx-auto py-3 px-4 sm:px-6 lg:px-8">
                        {{ $searchtitle }}
                    </div>
                    {{-- <div class="flex justify-between sm:justify-between max-w-7xl mx-auto py-3 px-4 sm:px-6 lg:px-8">
                        {{ $searchcontent }}
                    </div> --}}
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>

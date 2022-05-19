<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Security Patrol Clocking System') }}</title>

        <link rel="icon" type="image/x-icon" href="{{url('/img/favicon.svg')}}">

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        {{-- <link rel="stylesheet" href="{{ mix('css/app.css') }}"> --}}
        <link rel="stylesheet" href="{{ url('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        {{-- <script src="{{ mix('js/app.js') }}" defer></script> --}}
        <script src="{{ url('js/app.js') }}" defer></script>
        <script src="{{url('js/html5-qrcode.min.js')}}"></script>
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="flex flex-col min-h-screen justify-between bg-gray-100">
            <div>
                @livewire('navigation-menu')
            </div>
            <div class="items-start" style="margin-bottom: auto;">
                <!-- Page Heading -->
                @if (isset($header))
                    <header class="bg-white shadow">
                        <div class="flex justify-between sm:justify-between max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif

                <!-- Page Heading(Search) -->
                {{-- @if (isset($searchtitle) AND Auth::user()->usertype == 1) --}}
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
            <div class="mt-4 py-6 bg-white align-bottom">
                <span class="text-grey-300 text-base bottom-0 left-0 w-full flex justify-center align-bottom">Arsyad Zaini 
                    (SW0105692) | ©
                    <a href="https://imsmolelf.my" style="color:rgb(155, 132, 0);" target="blank">
                        &nbsp;imsmolelf.my
                    </a>
                </span>
            </div>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- {{ __('Landing') }} --}}
            Welcome Back, {{Auth::user()->name}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                {{-- <x-jet-welcome /> --}}
                @include('welcomee')
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <h1 class="antialiased font-semibold text-2xl text-gray-800"> Welcome Back, {{Auth::user()->name}} </h1>
            </div>
        </div>
    </div>

    {{-- <div class="py-2">
        <div class=" max-w-1xl mx-auto">
            <h1 class="antialiased font-semibold text-2xl text-gray-800"> Welcome Back, {{$ses['name']}} </h1>
        </div>
    </div> --}}
    <style>
    tr th, td{
        padding: 10px;
        background-color: rgba(253, 150, 150, 0.644);
        text-align: center;
    }
    </style>
    {{-- @if ($ses['usertype'] == 0)
        @include('public.landings.projects')
    @else
        @include('public.landings.admin')
    @endif --}}
</x-app-layout>
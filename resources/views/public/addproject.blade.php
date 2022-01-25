@if (Auth::user()->usertype == 1)
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- {{ __('Landing') }} --}}
            Add New Project
        </h2>
    </x-slot>

    <x-jet-authentication-card>
        <x-slot name="logo">
        </x-slot>
        <form method="POST" action="{{ url('projadd') }}">
            @csrf

            <div>
                <x-jet-label for="proj_name" value="{{ __('Project Name') }}" />
                <x-jet-input id="proj_name" class="block mt-1 w-full" type="text" name="proj_name" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="leader" value="{{ __('Project Leader') }}" />
                <select id="leader" 
                class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full" 
                name="leader" required >
                    @foreach ($lect as $lect)
                        <option value="{{$lect['id']}}">{{$lect['name']}}</option>
                    @endforeach
                </select>
            </div>

            <div class="mt-4">
                <x-jet-label for="proj_type" value="{{ __('Project Type') }}" />
                <select id="proj_type" 
                class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full" 
                name="proj_type" required >
                    <option value="0">Consultancy Project</option>
                    <option value="1">Research Grant Project</option>
                </select>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button>
                    {{ __('Add New Project') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-app-layout>
@else
<script type="text/javascript">
    window.location = "{{ url('/project') }}";
</script>
@endauth
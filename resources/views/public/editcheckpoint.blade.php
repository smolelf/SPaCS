<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- {{ __('Landing') }} --}}
            View/Edit Checkpoint Details
        </h2>
    </x-slot>
    
    <x-jet-authentication-card>
        <x-slot name="logo">
        </x-slot>
        <form method="POST" action="{{ url('updatecheckpoint') }}">
            @csrf

            <div class="hidden">
                <x-jet-label for="id" value="{{ __('ID') }}" />
                <x-jet-input id="id" class="block mt-1 w-full" type="text" name="id" value="{{$data->id}}" required />
            </div>
            
            <div>
                <x-jet-label for="cp_name" value="{{ __('Checkpoint Name') }}" />
                <x-jet-input id="cp_name" class="block mt-1 w-full" type="text" name="cp_name" value="{{$data->cp_name}}" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="cp_desc" value="{{ __('Checkpoint Description') }}" />
                <x-jet-input id="cp_desc" class="block mt-1 w-full" type="text" name="cp_desc" value="{{$data->cp_desc}}" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="cp_data" value="{{ __('Checkpoint Data') }}" />
                <x-jet-input id="cp_data" class="block mt-1 w-full" type="text" name="cp_data" value="{{$data->cp_data}}" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button>
                    {{ __('Update Checkpoint Details') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-app-layout>
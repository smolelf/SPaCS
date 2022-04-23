@if (Auth::user()->usertype == 1)
@else
<script type="text/javascript">
    window.location = "{{ url('/') }}"
</script>
@endif
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- {{ __('Landing') }} --}}
            Add New Checkpoint
        </h2>
    </x-slot>

    <x-jet-authentication-card>
        <x-slot name="logo">
        </x-slot>
        <form method="POST" action="{{ url('checkpointadd') }}">
            @csrf

            <div>
                <x-jet-label for="cp_name" value="{{ __('Checkpoint Name') }}" />
                <x-jet-input id="cp_name" class="block mt-1 w-full" type="text" name="cp_name" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="cp_desc" value="{{ __('Checkpoint Description') }}" />
                <x-jet-input id="cp_desc" class="block mt-1 w-full" type="text" name="cp_desc" required />
            </div>

            {{-- <div class="mt-4">
                <x-jet-label for="cp_data" value="{{ __('Checkpoint Data') }}" />
                <x-jet-input id="cp_data" class="block mt-1 w-full" type="text" name="cp_data" required />
            </div> --}}

            <div class="flex items-center justify-end mt-4">
                <x-jet-button>
                    {{ __('Add New Checkpoint') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-app-layout>
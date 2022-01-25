@auth
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Profile') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

            @include('public.profile.user-info')

            <x-jet-section-border />

            <div class="mt-10 sm:mt-0">

                @include('public.profile.update-password-form')

            </div>
            {{-- <x-jet-section-border />

            <div class="mt-10 sm:mt-0">
                @include('public.profile.delete-user-form')
            </div> --}}

        </div>
    </div>
</x-app-layout>
@else
<script type="text/javascript">
    window.setTimeout(function() {
        window.location = "{{ url('/') }}";
    }, 0);
</script>
@endauth
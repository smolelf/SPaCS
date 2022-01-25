@if (Auth::user()->usertype == 1)
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- {{ __('Landing') }} --}}
            Edit Existing User
        </h2>
    </x-slot>

    <x-jet-authentication-card>
        <x-slot name="logo">
        </x-slot>
        <form method="POST" action="{{ url('updateuser') }}">
            @csrf

            <div class="hidden">
                <x-jet-label for="id" value="{{ __('ID Number') }}" />
                <x-jet-input id="id" class="block mt-1 w-full" type="text" name="id" value="{{$data['id']}}" required />
            </div>

            <div>
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{$data['name']}}" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('E-mail') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{$data['email']}}" required  />
            </div>

            <div class="mt-4">
                <x-jet-label for="phone_no" value="{{ __('Phone Number') }}" />
                <x-jet-input id="phone_no" class="block mt-1 w-full" type="text" name="phone_no" value="{{$data['phone_no']}}" />
            </div>

            <div class="mt-4">
                <x-jet-label for="dept" value="{{ __('Department') }}" />
                <x-jet-input id="dept" class="block mt-1 w-full" type="text" name="dept" value="{{$data['dept']}}" />
            </div>

            <div class="mt-4">
                <x-jet-label for="usertype" value="{{ __('Admin/Project Manager') }}" />
                <select id="usertype" 
                        class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full text-left" 
                        name="usertype" >
                    <option value="0" @if ($data->usertype == 0) selected @endif>No</option>
                    <option value="1" @if ($data->usertype == 1) selected @endif>Yes</option>
                </select>
            </div>
            <div class="flex items-center justify-end mt-4">
                <x-jet-button>
                    {{ __('Update User Details') }}
                </x-jet-button>
            </div>

        </form>
        <form action="{{url('/resetpw')}}" method="POST">
            @csrf
            <div class="hidden">
                <x-jet-label for="id" value="{{ __('ID Number') }}" />
                <x-jet-input id="id" class="block mt-1 w-full" type="text" name="id" value="{{$data['id']}}" required />
            </div>
            <div class="flex justify-end">
                <button class="justify-end mt-4 inline-flex items-center px-4 py-2 bg-red-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:border-red-700 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                    Reset to Default Password
                </button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-app-layout>
@else
<script type="text/javascript">
    window.location = "{{ url('/user') }}";
</script>
@endauth
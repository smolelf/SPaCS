<div class="md:grid md:grid-cols-3 md:gap-6">

    <div class="md:col-span-1 flex justify-between">
        <div class="px-4 sm:px-0">
            <h3 class="text-lg font-medium text-gray-900">Profile Information</h3>
            <p class="mt-1 text-sm text-gray-600">
                Update your account's profile information.
            </p>
        </div>
    </div>

    <div class="hidden">
        {{$data = Auth::user()}}
    </div>

    <div class="mt-5 md:mt-0 md:col-span-2">
        <form method="POST" action="{{ url('updateself') }}">
            @csrf
            {{-- {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }} --}}
            <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
                <div class="grid grid-cols-6 gap-6">

                    <div class="hidden">
                        <x-jet-input id="id" class="block mt-1 w-full" type="text" name="id" value="{{$data->id}}" required />
                    </div>

                    <!-- Name -->
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="name" value="{{ __('Name') }}" />
                        <x-jet-input id="name" type="text" class="mt-1 block w-full" name="name" value="{{$data->name}}" required />
                        <x-jet-input-error for="name" class="mt-2" />
                    </div>
            
                    <!-- Email -->
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="email" value="{{ __('Email') }}" />
                        <x-jet-input id="email" type="email" class="mt-1 block w-full" name="email" value="{{$data->email}}" required />
                        <x-jet-input-error for="email" class="mt-2" />
                    </div>

                    <!-- Phone No. -->
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="phone_no" value="{{ __('Phone No.') }}" />
                        <x-jet-input id="phone_no" type="text" class="mt-1 block w-full" name="phone_no" value="{{$data->phone_no}}" required />
                        <x-jet-input-error for="phone_no" class="mt-2" />
                    </div>

                    <!-- Department -->
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="dept" value="{{ __('Department') }}" />
                        <x-jet-input id="dept" type="text" class="mt-1 block w-full" name="dept" value="{{$data->dept}}" required />
                        <x-jet-input-error for="dept" class="mt-2" />
                    </div>

                    {{-- <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="dept" value="{{ __('Department') }}" />
                        <x-jet-input id="dept" type="text" class="mt-1 block w-full" name="dept" value="{{$data->dept}}" required />
                        <x-jet-input-error for="dept" class="mt-2" />
                    </div> --}}
                </div>
            </div>
            <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                <x-jet-button>
                    {{ __('Update Profile') }}
                </x-jet-button>
            </div>
        </form>
    </div>
</div>
<div class="md:grid md:grid-cols-3 md:gap-6">

    <div class="md:col-span-1 flex justify-between">
        <div class="px-4 sm:px-0">
            <h3 class="text-lg font-medium text-gray-900">Update Password</h3>
            <p class="mt-1 text-sm text-gray-600">
                Ensure your account is using a long, random password to stay secure.
            </p>
        </div>
    </div>

    <div class="hidden">
        {{$data = Auth::user()}}
    </div>

    <div class="mt-5 md:mt-0 md:col-span-2">
        <form method="POST" action="{{ url('updateselfpw') }}">
            @csrf
            {{-- {{ isset($actions) ? 'sm:rounded-tl-md sm:rounded-tr-md' : 'sm:rounded-md' }} --}}
            <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
                <div class="grid grid-cols-6 gap-6">

                    <div class="hidden">
                        <x-jet-input id="id" class="block mt-1 w-full" type="text" name="id" value="{{$data->id}}" required />
                    </div>

                    <!-- Current Password -->
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="cpw" value="{{ __('Current Password') }}" />
                        <x-jet-input id="cpw" type="password" class="mt-1 block w-full" name="cpw" required />
                        <x-jet-input-error for="cpw" class="mt-2" />
                    </div>

                    <!-- New Password -->
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="pw" value="{{ __('New Password') }}" />
                        <x-jet-input id="pw" type="password" class="mt-1 block w-full" name="pw" required />
                        <x-jet-input-error for="pw" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="col-span-6 sm:col-span-4">
                        <x-jet-label for="cfpw" value="{{ __('Confirm New Password') }}" />
                        <x-jet-input id="cfpw" type="password" class="mt-1 block w-full" name="cfpw" required />
                        <x-jet-input-error for="cfpw" class="mt-2" />
                    </div>

                </div>
            </div>
            <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                <x-jet-button>
                    {{ __('Save') }}
                </x-jet-button>
            </div>
        </form>
    </div>
</div>
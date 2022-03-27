@if (Auth::user()->usertype == 1)
<x-app-layout>
    <x-guest-layout>
        <x-jet-authentication-card>
            <x-slot name="logo">
                {{-- <x-jet-authentication-card-logo /> --}}
                {{-- <img src="/img/spacs.svg" class="block h-20 w-auto" style="height:5rem"/> --}}
                <img src="{{url('/img/spacs2.svg')}}" style="height:13rem"/>
            </x-slot>
    
            <x-jet-validation-errors class="mb-4" />
    
            <form method="GET" action="{{ url('/report/generate') }}">
                @csrf
    
                <div>
                    <x-jet-label for="pic" value="{{ __('Person In Charge') }}" />
                    {{-- <x-jet-input id="pic" class="block mt-1 w-full" type="text" name="pic" required autofocus autocomplete="pic" /> --}}
                    <select id="pic" 
                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full" 
                    name="pic"  >
                    <option value="">Select Person In Charge</option>
                        @foreach ($user as $user)
                            <option value="{{$user['id']}}">{{$user['name']}}</option>
                        @endforeach
                    </select>
                </div>
    
                <div class="mt-4">
                    <x-jet-label for="cp" value="{{ __('Checkpoint') }}" />
                    {{-- <x-jet-input id="cp" class="block mt-1 w-full" type="text" name="cp" required /> --}}
                    <select id="cp" 
                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full" 
                    name="cp"  >
                        <option value="">Select Checkpoint</option>
                        @foreach ($cp as $cp)
                            <option value="{{$cp['id']}}">{{$cp['cp_name']}}</option>
                        @endforeach
                    </select>
                </div>
    
                <div class="mt-4">
                    <x-jet-label for="date" value="{{ __('Data Range') }}" />
                    {{-- <x-jet-input id="cp" class="block mt-1 w-full" type="text" name="cp" required /> --}}
                    <select id="date" 
                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full" 
                    name="date" onchange="hide()">
                        <option value="week">Weekly</option>
                        <option value="biweek">Bi-Weekly</option>
                        <option value="month">Monthly</option>
                        <option value="quart">Quarterly</option>
                    </select>
                </div>

                <div class="mt-4" id="months" style="display: none">
                    <x-jet-label for="mth" value="{{ __('Month') }}" />
                    <select id="mth" 
                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full" 
                    name="mth" >
                        <option value="jan">January</option>
                        <option value="feb">February</option>
                        <option value="mar">March</option>
                        <option value="apr">April</option>
                        <option value="may">May</option>
                        <option value="jun">June</option>
                        <option value="jul">July</option>
                        <option value="aug">August</option>
                        <option value="sep">September</option>
                        <option value="oct">October</option>
                        <option value="nov">November</option>
                        <option value="dec">December</option>
                    </select>
                </div>

                <div class="mt-4" id="years" style="display: none">
                    <x-jet-label for="year" value="{{ __('Year') }}" />
                    <select id="year" 
                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full" 
                    name="year" >
                        <option value="2022">2022</option>
                        <option value="2022">2021</option>
                    </select>
                </div>

                {{-- <div class="mt-4">
                    <x-jet-label for="datetime" value="Date & Time Range" />
                    <x-jet-input id="datetimestart" class="block mt-1 w-full" type="datetime-local" name="datetimestart"  />
                    <h6 class="my-4 text-center">to</h6>
                    <x-jet-input id="datetimeend" class="block w-full" type="datetime-local" name="datetimeend"  />
                </div> --}}
    
                <div class="flex items-center justify-end mt-4">
                    <x-jet-button class="ml-4">
                        {{ __('Generate Report') }}
                    </x-jet-button>
                </div>
            </form>
        </x-jet-authentication-card>
    </x-guest-layout>
</x-app-layout>
<script type="text/javascript">
    function hide() {
        var x = document.getElementById("date").value;
        if (x == "month") {
            document.getElementById("months").style.display= '';
            document.getElementById("years").style.display= '';
        }else{
            document.getElementById("months").style.display= 'none';
            document.getElementById("years").style.display= 'none';
        }
    }
</script>
@else
<script type="text/javascript">
    window.location = "{{ url('/user') }}";
</script>
@endauth
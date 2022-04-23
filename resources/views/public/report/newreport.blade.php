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
    
            <form method="POST" action="{{ url('/report/xport') }}">
                @csrf
    
                <div>
                    <x-jet-label for="pic" value="{{ __('Person In Charge') }}" />
                    {{-- <x-jet-input id="pic" class="block mt-1 w-full" type="text" name="pic" required autofocus autocomplete="pic" /> --}}
                    <select id="pic" 
                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full" 
                    name="pic"  >
                    <option value="all">All</option>
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
                        <option value="all">All</option>
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
                        <option value="lastweek">Last Week</option>
                        <option value="thisweek">This Week</option>
                        <option value="month">Monthly</option>
                        <option value="custom">Custom Range</option>
                    </select>
                </div>

                <div class="hidden">
                    <?php
                        $mthh = date('m');
                        $yrrr = date('Y');
                    ?>
                </div>

                <div class="mt-4" id="months" style="display: none">
                    <x-jet-label for="mnth" value="{{ __('Month') }}" />
                    <select id="mth" 
                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full" 
                    name="mth" >
                        <option value="january" @if($mthh == "01") selected @endif>January</option>
                        <option value="february" @if($mthh == "02") selected @endif>February</option>
                        <option value="march" @if($mthh == "03") selected @endif>March</option>
                        <option value="april" @if($mthh == "04") selected @endif>April</option>
                        <option value="may" @if($mthh == "05") selected @endif>May</option>
                        <option value="june" @if($mthh == "06") selected @endif>June</option>
                        <option value="july" @if($mthh == "07") selected @endif>July</option>
                        <option value="august" @if($mthh == "08") selected @endif>August</option>
                        <option value="september" @if($mthh == "09") selected @endif>September</option>
                        <option value="october" @if($mthh == "10") selected @endif>October</option>
                        <option value="november" @if($mthh == "11") selected @endif>November</option>
                        <option value="december" @if($mthh == "12") selected @endif>December</option>
                    </select>
                </div>

                <div class="mt-4" id="years" style="display: none">
                    <x-jet-label for="year" value="{{ __('Year') }}" />
                    <select id="year" 
                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm block mt-1 w-full" 
                    name="year" >
                        <option value="2021" @if($yrrr == "2021") selected @endif>2021</option>
                        <option value="2022" @if($yrrr == "2022") selected @endif>2022</option>
                    </select>
                </div>

                <div class="mt-4" id="custom" style="display: none">
                    <x-jet-label for="datetime" value="Date & Time Range" />
                    <x-jet-input id="datetimestart" class="block mt-1 w-full" type="date" name="datetimestart"  />
                    <h6 class="my-4 text-center">to</h6>
                    <x-jet-input id="datetimeend" class="block w-full" type="date" name="datetimeend"  />
                </div>
    
                <div class="flex items-center justify-end mt-4">
                    <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"
                    type="submit" name="format" value="xlsx" style="margin-right: 1rem;">
                        Generate Report (XLSX)
                    </button>
                    <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"
                    type="submit" name="format" value="pdf" style="margin-left: 1rem;"">
                        Generate Report (PDF)
                    </button>
                </div>

                {{-- <div class="flex items-center justify-end mt-4">
                    <x-jet-button class="ml-4">
                        {{ __('Generate Report (PDF)') }}
                    </x-jet-button>
                </div> --}}

            </form>
        </x-jet-authentication-card>
    </x-guest-layout>
</x-app-layout>
<script type="text/javascript">
    function hide() {
        var x = document.getElementById("date").value;
        var elmnt1 = document.getElementById("months");
        var elmnt2 = document.getElementById("years");
        var elmnt3 = document.getElementById("custom");
        if (x == "month") {
            elmnt1.style.display = "";
            elmnt2.style.display = "";
            elmnt3.style.display = "none";
        }else if(x == "custom"){
            elmnt1.style.display = "none";
            elmnt2.style.display = "none";
            elmnt3.style.display = "";
        }else{
            elmnt1.style.display = "none";
            elmnt2.style.display = "none";
            elmnt3.style.display = "none";
        }
    }
</script>
@else
<script type="text/javascript">
    window.location = "{{ url('/') }}";
</script>
@endauth
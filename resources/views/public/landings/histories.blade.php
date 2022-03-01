<style>
    tr th, tr td{
        padding: 1rem 1rem;
        /*background-color: rgba(253, 150, 150, 0.644);*/
        text-align: center;
        border: 1px solid rgb(218, 218, 218);
        border-radius: 0.5rem;
    }
</style>
<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{-- {{ __('Landing') }} --}}
        Scan Histories
    </h2>
    @if (Auth::user()->usertype == 1)
    <a href="{{url('/report/new')}}" class="text-gray-500 hover:text-gray-900 text-right text-l sm:text-right sm:ml-0">
        Generate report
    </a>
    @endif
</x-slot>
<x-slot name="searchtitle">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{-- {{ __('User') }} --}}
    </h2>
    <form action="{{url('/history/search')}}" style="margin-bottom: 0px;" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        @if(isset($init2))
            <x-jet-input type="hidden" id="add_search" name="add_search" placeholder="Search query" value="{{$init2}}"/>
        @else
            <x-jet-input type="hidden" id="add_search" name="add_search" placeholder="Search query"/>
        @endif
        <span id="to" style="display: none;" class="px-2">to</span>
        @if(isset($init1))
            <x-jet-input type="text" id="search" name="search" placeholder="Search query" value="{{$init1}}"/>
        @else
            <x-jet-input type="text" id="search" name="search" placeholder="Search query"/>
        @endif
        <select name="searchby" id="searchby"
        class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm text-left mt-0 sm:mt-2"
        onchange="add_opt()">
            <option value="cp" @if (isset($searchby) AND $searchby == 'cp') selected @endif>Checkpoint</option>
            <option value="pic" @if (isset($searchby) AND $searchby == 'pic') selected @endif>PIC</option>
            <option value="datetime" @if (isset($searchby) AND $searchby == 'datetime') selected @endif>Date & Time</option>
            {{-- <option value="time">Time</option> --}}
        </select>
        <x-jet-button type="submit" name="submit" class="py-3">Search</x-jet-button>
    </form>
</x-slot>
<div class="relative flex items-top justify-center bg-gray-100 dark:bg-gray-900 sm:items-center py-10">
    <div class="max-w-9xl mx-auto sm:px-6 lg:px-10">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg">
            <table>
                <tr>
                    <th>Checkpoint Name</th>
                    {{-- <th>Desc</th> --}}
                    <th>P.I.C.</th>
                    <th>Date</th>
                    <th>Time</th>
                    {{-- <th>Operation</th> --}}
                </tr>
                @foreach ($data as $data)
                <tr>
                    <td>{{$data->cp_name}}</td>
                    {{-- <td>{{$data->cp_desc}}</td> --}}
                    <td>{{$data->name}}</td>
                    {{-- <td>{{date('l, d/m/Y', strtotime($data->created_at))}}</td> l for long day, D for short day--}}
                    <td>{{date('d/m/Y', strtotime($data->created_at))}}</td>
                    <td>{{date('h:i:s a', strtotime($data->created_at))}}</td>
                    {{-- <td><a href="{{url('/edithist/'.$data->id)}}" class="underline" style="color:rgb(0, 104, 122)">View Details</a></td> --}}
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
</x-app-layout>
<script>
    window.onload = load();
    function load(){
        var x = document.getElementById("searchby").value;
        if (x == "datetime") {
            document.getElementById("add_search").type = "datetime-local";
            document.getElementById("add_search").placeholder = "Start date";
            document.getElementById("search").placeholder = "End date";
            document.getElementById("search").type = "datetime-local";
            document.getElementById("to").style.display= '';
        }
    }
    function add_opt() {
        var x = document.getElementById("searchby").value;
        if (x == "datetime") {
            document.getElementById("add_search").type = "datetime-local";
            document.getElementById("add_search").placeholder = "Start date";
            document.getElementById("search").placeholder = "End date";
            document.getElementById("search").type = "datetime-local";
            document.getElementById("to").style.display= '';
        }else{
            document.getElementById("add_search").type = "hidden";
            document.getElementById("search").placeholder = "Search query";
            document.getElementById("search").type = "text";
            document.getElementById("search").value = "";
            document.getElementById("add_search").value = "";
            document.getElementById("to").style.display= 'none';
        }
    }
</script>
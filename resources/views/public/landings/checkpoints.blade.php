<style>
    tr th, tr td{
        padding: 1rem 1rem;
        /*background-color: rgba(253, 150, 150, 0.644);*/
        text-align: center;
        border: 1px solid rgb(218, 218, 218);
        border-radius: 0.5rem;
    }
</style>
@if (Auth::user()->usertype == 1)
@else
<script type="text/javascript">
    window.location = "{{ url('/') }}"
</script>
@endif
<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Checkpoints') }}
    </h2>
    <a href="{{url('/restcp')}}" class="text-gray-500 hover:text-gray-900 text-right text-l sm:text-right sm:ml-0">
        Restore Checkpoint
    </a>
    <a href="{{url('/addcheckpoint')}}" class="text-gray-500 hover:text-gray-900 text-right text-l sm:text-right sm:ml-0">
        New Checkpoint
    </a>
</x-slot>
<x-slot name="searchtitle">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{-- {{ __('Checkpoints') }} --}}
    </h2>
    <form action="{{url('/checkpoint/search')}}" style="margin-bottom: 0px;" method="GET">
        {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}
        @if(isset($init))
            <x-jet-input type="text" name="q" placeholder="Search query" class="" value="{{$init}}"/>
        @else
            <x-jet-input type="text" name="q" placeholder="Search query" class="form-control"/>
        @endif
        <select name="searchby"
        class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm text-left" >
            <option value="name" @if (isset($searchby) AND $searchby == 'name') selected @endif>Name</option>
            <option value="desc" @if (isset($searchby) AND $searchby == 'desc') selected @endif>Description</option>
        </select>
        <x-jet-button type="submit" class="py-3">Search</x-jet-button>
    </form>
</x-slot>
<div class="relative flex items-top justify-center bg-gray-100 dark:bg-gray-900 sm:items-center py-10">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-10">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg">
            <table>
                <tr>
                    <th>Checkpoint Name</th>
                    <th>Checkpoint Desc</th>
                    {{-- <th>Delete?</th> --}}
                </tr>
                @foreach ($data as $datas)
                <tr>
                    <td><a href="{{url('/editcheckpoint/'.$datas->id)}}" class="underline" style="color:rgb(0, 104, 122)">{{$datas->cp_name}}</a></td>
                    <td>{{$datas->cp_desc}}</td>
                    {{-- <td><a href="{{url('/delcp/'.$data->id)}}" class="underline" style="color:rgb(0, 104, 122)">Delete</a></td> --}}
                </tr>
                @endforeach
            </table>
        </div>
        <div class="pt-4">
        {{$data->links()}}
        </div>
    </div>
</div>
</x-app-layout>
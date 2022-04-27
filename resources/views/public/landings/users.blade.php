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
    <div class="text-left sm:text-left font-semibold text-xl text-gray-800">
        {{-- {{ __('Landing') }} --}}
        Users
    </div>
    @if (Auth::user()->usertype == 1)
    <a href="{{url('/restuser')}}" class="text-gray-500 hover:text-gray-900 text-right text-l sm:text-right sm:ml-0">
        Restore User
    </a>
    <a href="{{url('/adduser')}}" class="text-gray-500 hover:text-gray-900 text-right text-l sm:text-right sm:ml-0">
        New User
    </a>
    @endif
</x-slot>
<x-slot name="searchtitle">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{-- {{ __('User') }} --}}
    </h2>
    <form action="{{url('/user/search')}}" style="margin-bottom: 0px;" method="GET">
        {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}
        @if(isset($init))
            <x-jet-input type="text" name="q" placeholder="Search query" value="{{$init}}" />
        @else
            <x-jet-input type="text" name="q" placeholder="Search query" />
        @endif
        <select name="searchby"
        class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm text-left" >
            <option value="name" @if (isset($searchby) AND $searchby == 'name') selected @endif>Name</option>
            <option value="phone" @if (isset($searchby) AND $searchby == 'phone') selected @endif>Phone #</option>
            {{-- <option value="dept" @if (isset($searchby) AND $searchby == 'dept') selected @endif>Department</option> --}}
        </select>
        <x-jet-button type="submit" class="py-3">Search</x-jet-button>
    </form>
</x-slot>
<div class="relative flex items-top justify-center bg-gray-100 dark:bg-gray-900 sm:items-center py-10">
    <div class="max-w-9xl mx-auto sm:px-6 lg:px-10">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg">
            <table>
                <tr>
                    <th>Name</th>
                    <th>Phone Number</th>
                    {{-- <th>Department</th> --}}
                    {{-- <th>Project(s) Lead</th> --}}
                    {{-- @if (Auth::user()->usertype == 1)
                    <th>Action</th>
                    @endif --}}
                </tr>
                @foreach ($data as $datas)
                <div class="hidden">
                    {{-- {{$check = DB::table('projects')->where('leader', '=', $data->id)->get();}}
                    {{$count = $check->count();}} --}}
                </div>
                <tr>
                    {{-- @if (Auth::user()->usertype == 1) --}}
                    @if (Auth::user()->id != $datas->id AND Auth::user()->usertype == 1)
                        <td><a href="{{url('/edituser/'.$datas->id)}}" class="underline" style="color:rgb(0, 104, 122)">{{$datas->name}}</a></td>
                    @else
                        <td><h1 class="text-black-400">{{$datas->name}}</h1></td>
                    @endif
                    {{-- @endif --}}
                    <td>{{$datas->phone_no}}</td>
                    {{-- <td>{{$datas->dept}}</td> --}}
                    {{-- @if (Auth::user()->usertype == 1)
                        @if (Auth::user()->id == $datas->id)
                            <td><h1 class="text-gray-400">Delete</h1></td>
                        @else
                            <td><a href="{{url('/deluser/'.$datas->id)}}" class="underline" style="color:rgb(0, 104, 122)">Delete</a></td>
                        @endif
                    @endif --}}
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
            {{-- // ->leftJoin('users','projects.leader','=','users.id')
            // ->leftJoin('proj_statuses','projects.proj_status','=','proj_statuses.id')
            // ->leftJoin('proj_stages','projects.proj_stage','=','proj_stages.id')
            // ->where('projects.leader', '=', $user['id'])
            // ->select('projects.*','users.name','proj_statuses.stat_desc AS stat','proj_stages.stage_desc AS stage')
            ->get();}} --}}
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
    <div class="text-left sm:text-left font-semibold text-xl text-gray-800">
        {{-- {{ __('Landing') }} --}}
        Users
    </div>
    @if (Auth::user()->usertype == 1)
    <a href="{{url('/adduser')}}" class="text-gray-500 hover:text-gray-900 text-right text-l sm:text-right sm:ml-0">
        New User
    </a>
    @endif
</x-slot>
<x-slot name="searchtitle">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{-- {{ __('User') }} --}}
    </h2>
    <form action="/user/search" style="margin-bottom: 0px;" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <x-jet-input type="text" name="search" placeholder="Search query" class="form-control"/>
        <select name="searchby"
        class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm text-left" >
            <option value="name">Name</option>
            <option value="dept">Department</option>
        </select>
        <x-jet-button type="submit" name="submit" class="py-3">Search</x-jet-button>
    </form>
</x-slot>
<div class="relative flex items-top justify-center bg-gray-100 dark:bg-gray-900 sm:items-center py-10">
    <div class="max-w-9xl mx-auto sm:px-6 lg:px-10">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg">
            <table>
                <tr>
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>Department</th>
                    {{-- <th>Project(s) Lead</th> --}}
                    @if (Auth::user()->usertype == 1)
                    <th colspan="2">Action</th>
                    @endif
                </tr>
                @foreach ($data as $data)
                <div class="hidden">
                    {{-- {{$check = DB::table('projects')->where('leader', '=', $data->id)->get();}}
                    {{$count = $check->count();}} --}}
                </div>
                <tr>
                    <td>{{$data->name}}</td>
                    <td>{{$data->phone_no}}</td>
                    <td>{{$data->dept}}</td>
                    {{-- <td>
                    @if ($count != '[]')
                        @if ($count > 1)
                            {{$count}} Projects
                        @else
                            {{$count}} Project
                        @endif
                    @else
                        N/A
                    @endif
                    </td> --}}
                    @if (Auth::user()->usertype == 1)
                        @if (Auth::user()->id != $data->id)
                            <td><a href="{{url('/edituser/'.$data->id)}}" class="underline" style="color:rgb(0, 104, 122)">Edit</a></td>
                        @else
                            <td><h1 class="text-gray-400">Edit</h1></td>
                        @endif
                    @endif
                    @if (Auth::user()->usertype == 1)
                        {{-- @if ($data['usertype'] == 1 OR $count != '[]')
                            <td><h1 class="text-gray-400">Delete</h1></td>
                        @else --}}
                            <td><a href="{{url('/deluser/'.$data->id)}}" class="underline" style="color:rgb(0, 104, 122)">Delete</a></td>
                        {{-- @endif --}}
                    @endif
                </tr>
                @endforeach
            </table>
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
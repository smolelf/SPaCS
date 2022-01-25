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
        Projects
    </div>
    @if (Auth::user()->usertype == 1)
    <a href="{{url('/addproject')}}" class="text-gray-500 hover:text-gray-900 text-right text-l sm:text-right sm:ml-0">
        New Project
    </a>
    @endif
</x-slot>
<div class="relative flex items-top justify-center bg-gray-100 dark:bg-gray-900 sm:items-center py-10">
    <div class="max-w-9xl mx-auto sm:px-6 lg:px-10">
        @if ($cons != '[]')
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg">
            <div>
                <h1 class="text-2xl px-4 py-4 text-gray-700 font-semibold">Consultancy Project</h1>
            </div>
            <table border="1" class="w-full table-auto">
                <tr>
                    <th>Project Name</th>
                    <th>Leader</th>
                    <th>Stage</th>
                    <th>Status</th>
                    <th colspan="2">Operations</th>
                </tr>
                @foreach ($cons as $cons)
                <tr>
                    <td>{{$cons->proj_name}}</td>
                    <td>{{$cons->name}}</td>
                    <td>{{$cons->stage}}</td>
                    <td>{{$cons->stat}}</td>
                    @if ($cons->proj_stage == '6' AND $cons->proj_status == '5')
                        <td><h1 class=" text-gray-400">Closed</h1></td>
                    @else
                        <td><a href="/editproj/{{$cons->id}}" class="underline" style="color:rgb(0, 104, 122)">View Detail</a></td>
                    @endif
                    @if ($cons->proj_stage == '6' AND $cons->proj_status == '5')
                        <td><h1 class=" text-gray-400">Closed</h1></td>
                    @elseif($cons->proj_mem_num > 0)
                        <td><a href="/editmember/{{$cons->id}}" class="underline" style="color:rgb(0, 104, 122)">Manage Member</a></td>
                    @else
                        <td><h1 class=" text-gray-400">No Member</h1></td>
                    @endif
                </tr>
                @endforeach
            </table>
        </div>
        @else
        <div class="py-4">
            <h1 class="text-4xl font-semibold text-center"> No Consultancy Project Involved </h1>
        </div>
        @endif
        <x-jet-section-border />
        @if ($rsch != '[]')
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg">
            <div>
                <h1 class="text-2xl px-4 py-4 text-gray-700 font-semibold">Research Grant Project</h1>
            </div>
            <table border="1" class="w-full table-auto">
                <tr>
                    <th>Project Name</th>
                    <th>Leader</th>
                    <th>Stage</th>
                    <th>Status</th>
                    <th colspan="2">Operations</th>
                </tr>
                @foreach ($rsch as $rsch)
                <tr>
                    <td>{{$rsch->proj_name}}</td>
                    <td>{{$rsch->name}}</td>
                    <td>{{$rsch->stage}}</td>
                    <td>{{$rsch->stat}}</td>
                    @if ($rsch->proj_stage == '6' AND $rsch->proj_status == '5')
                        <td><h1 class=" text-gray-400">Closed</h1></td>
                    @else
                        <td><a href="/editproj/{{$rsch->id}}" class="underline" style="color:rgb(0, 104, 122)">View Detail</a></td>
                    @endif
                    @if ($rsch->proj_stage == '6' AND $rsch->proj_status == '5')
                        <td><h1 class=" text-gray-400">Closed</h1></td>
                    @elseif($rsch->proj_mem_num > 0)
                        <td><a href="/editmember/{{$rsch->id}}" class="underline" style="color:rgb(0, 104, 122)">Manage Member</a></td>
                    @else
                        <td><h1 class=" text-gray-400">No Member</h1></td>
                    @endif
                </tr>
                @endforeach
            </table>
        </div>
        @else
        <div class="py-4">
            <h1 class="text-4xl font-semibold text-center"> No Research Project Involved </h1>
        </div>
        <x-jet-section-border />
        @endif
    </div>
</div>
</x-app-layout>
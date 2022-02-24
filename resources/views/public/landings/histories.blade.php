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
<div class="relative flex items-top justify-center bg-gray-100 dark:bg-gray-900 sm:items-center py-10">
    <div class="max-w-9xl mx-auto sm:px-6 lg:px-10">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg">
            <table>
                <tr>
                    <th>Checkpoint Name</th>
                    <th>Desc</th>
                    <th>P.I.C.</th>
                    <th>Date</th>
                    <th>Time</th>
                    {{-- <th>Operation</th> --}}
                </tr>
                @foreach ($data as $data)
                <tr>
                    <td>{{$data->cp_name}}</td>
                    <td>{{$data->cp_desc}}</td>
                    <td>{{$data->name}}</td>
                    <td>{{date('l, d/m/Y', strtotime($data->created_at))}}</td>
                    <td>{{date('h:i:s a', strtotime($data->created_at))}}</td>
                    {{-- <td><a href="{{url('/edithist/'.$data->id)}}" class="underline" style="color:rgb(0, 104, 122)">View Details</a></td> --}}
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
</x-app-layout>
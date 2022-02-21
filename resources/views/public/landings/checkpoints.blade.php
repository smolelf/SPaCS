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
        {{ __('Checkpoints') }}
        {{-- Checkpoints --}}
    </h2>
    <a href="{{url('/addcheckpoint')}}" class="text-gray-500 hover:text-gray-900 text-right text-l sm:text-right sm:ml-0">
        New Checkpoint
    </a>
</x-slot>
<x-slot name="searchtitle">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{-- {{ __('Checkpoints') }} --}}
    </h2>
    <form action="{{url('/checkpoint/search')}}" style="margin-bottom: 0px;" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <x-jet-input type="text" name="search" placeholder="Search query" class="form-control"/>
        <select name="searchby"
        class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm text-left" >
            <option value="name">Name</option>
            <option value="desc">Description</option>
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
                    <th>Checkpoint Desc</th>
                    <th>Action</th>
                </tr>
                @foreach ($data as $data)
                <tr>
                    <td>{{$data->cp_name}}</td>
                    <td>{{$data->cp_desc}}</td>
                    <td><a href="{{url('/editcheckpoint/'.$data->id)}}" class="underline" style="color:rgb(0, 104, 122)">View Details</a></td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
</x-app-layout>
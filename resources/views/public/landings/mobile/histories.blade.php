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
        {{ __('Scan Histories') }}
    </h2>
</x-slot>
<div class="relative flex items-top justify-center bg-gray-100 dark:bg-gray-900 sm:items-center py-10">
    <div class="max-w-9xl mx-auto sm:px-6 lg:px-10">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg">
            <table>
                <tr>
                    <th>Checkpoint Name</th>
                    <th>Desc</th>
                    <th>Date</th>
                    <th>Time</th>
                </tr>
                @foreach ($data as $datas)
                <tr>
                    <td>{{$datas->cp_name}}</td>
                    <td>{{$datas->cp_desc}}</td>
                    <td>{{date('d/m/Y', strtotime($datas->created_at))}}</td> {{-- l for long day, D for short day --}}
                    <td>{{date('h:i:s a', strtotime($datas->created_at))}}</td>
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
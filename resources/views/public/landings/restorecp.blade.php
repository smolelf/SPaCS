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
        {{ __('Restore Checkpoint') }}
    </div>
</x-slot>
<x-slot name="searchtitle">
    {{ __('Click checkpoint name to restore') }}
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
                    <td><a href="{{url('/restcp/'.$datas->id)}}" class="underline" style="color:rgb(0, 104, 122)">{{$datas->cp_name}}</a></td>
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
<?php
    // $x = \App\Models\Checkpoint::where('id', '=', '1')->where('cp_name', '=', 'Side Entrance')->get();
    // if($x == "[]"){
    //     echo $x." apaan dong if";
    // }else{
    //     echo $x." apaan dong else";
    // }
?>
</x-app-layout>
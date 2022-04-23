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
        {{ __('Restore Users') }}
    </div>
</x-slot>
<x-slot name="searchtitle">
    {{ __('Click name to restore') }}
</x-slot>
<div class="relative flex items-top justify-center bg-gray-100 dark:bg-gray-900 sm:items-center py-10">
    <div class="max-w-9xl mx-auto sm:px-6 lg:px-10">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg">
            <table>
                <tr>
                    <th>Name</th>
                    <th>Phone Number</th>
                </tr>
                @foreach ($data as $datas)
                <tr>
                    @if (Auth::user()->id != $datas->id AND Auth::user()->usertype == 1)
                        <td><a href="{{url('/restus/'.$datas->id)}}" class="underline" style="color:rgb(0, 104, 122)">{{$datas->name}}</a></td>
                    @else
                        <td><h1 class="text-black-400">{{$datas->name}}</h1></td>
                    @endif
                    <td>{{$datas->phone_no}}</td>
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
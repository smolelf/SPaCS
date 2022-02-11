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
        Clients
    </h2>
    <a href="{{url('/addclient')}}" class="text-gray-500 hover:text-gray-900 text-right text-l sm:text-right sm:ml-0">
        New Client
    </a>
</x-slot>
<div class="relative flex items-top justify-center bg-gray-100 dark:bg-gray-900 sm:items-center py-10">
    <div class="max-w-9xl mx-auto sm:px-6 lg:px-10">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg">
            <table>
                <tr>
                    <th>Client Name</th>
                    <th>Client E-Mail</th>
                    <th>Client Phone Number</th>
                    <th>Action</th>
                </tr>
                @foreach ($data as $data)
                <tr>
                    <td>{{$data['cl_name']}}</td>
                    <td>{{$data['cl_email']}}</td>
                    <td>{{$data['cl_phone_no']}}</td>
                    <td><a href="{{url('/editclient/'.$data['id'])}}" class="underline" style="color:rgb(0, 104, 122)">View Details</a></td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
</x-app-layout>
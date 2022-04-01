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
        Scan QR
    </h2>
</x-slot>
<div class="relative flex items-top justify-center bg-gray-100 dark:bg-gray-900 sm:items-center py-10">
    <div class="max-w-9xl mx-auto sm:px-6 lg:px-10">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg">
            {{-- <table>
                <tr>
                    <th>Checkpoint Name</th>
                    <th>Desc</th>
                    <th>Date</th>
                    <th>Time</th>
                </tr>
                @foreach ($data as $data)
                <tr>
                    <td>{{$data->cp_name}}</td>
                    <td>{{$data->cp_desc}}</td>
                    <td>{{date('d/m/Y', strtotime($data->created_at))}}</td>
                    <td>{{date('h:i:s a', strtotime($data->created_at))}}</td>
                </tr>
                @endforeach
            </table> --}}
            <script type="text/javascript" src="instascan.min.js"></script>
            <video id="preview"></video>
                <script type="text/javascript">
                let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
                scanner.addListener('scan', function (content) {
                    console.log(content);
                });
                Instascan.Camera.getCameras().then(function (cameras) {
                    if (cameras.length > 0) {
                    scanner.start(cameras[0]);
                    } else {
                    console.error('No cameras found.');
                    }
                }).catch(function (e) {
                    console.error(e);
                });
                </script>
            </body>
        </div>
        <h1> TEST </h1>
    </div>
</div>
</x-app-layout>
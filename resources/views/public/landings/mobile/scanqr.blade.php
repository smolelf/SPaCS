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
            <div class="py-4 px-4 text-center">
                <span class="text-lg font-semibold">Please allow camera permission to begin scanning QR Code</span>
            </div>
            <div class="max-w-screen-lg" id="reader"></div>
            <form method="POST" action="{{url('/mobile/scanned')}}" id="form" style="margin-bottom: 0px">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="cp_id" id="result">
                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                {{-- <input type="submit"> --}}
            </form>
            </body>
        </div>
        {{-- <h1> TEST </h1> --}}
    </div>
</div>
</x-app-layout>
<script>
    window.onload = test();
    
    function test(){
        <?php
        ?>
    };

    function onScanSuccess(decodedText, decodedResult) {
        <?php

            $datas = json_encode($data);
            echo "var jsarray = ". $datas . ";";
        ?>
        var found = "false";
        for(let element of jsarray){
            if(element.cp_data == decodedText){
                html5QrcodeScanner.clear();
                // alert("Valid checkpoint!");
                document.getElementById('result').value = element.id;
                found = "true";
                document.getElementById('form').submit();
                break;                
            }
        }
        if (found == "false"){
            alert("Not a valid Checkpoint!");
        }
    }

    // function onScanError(errorMessage) {
    //     // handle on error condition, with error message
    //     alert("Error! " + errorMessage);
    // }

    var html5QrcodeScanner = new Html5QrcodeScanner(
        "reader",
        {
            fps: 60,
            qrbox: 300,
            rememberLastUsedCamera: true,
            formatsToSupport: [Html5QrcodeSupportedFormats.QR_CODE],
            facingMode: { exact: "environment"},
            supportedScanTypes: [Html5QrcodeScanType.SCAN_TYPE_CAMERA]
        }
    );

    html5QrcodeScanner.render(onScanSuccess);

</script>
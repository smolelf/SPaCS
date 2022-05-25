@if (Auth::user()->usertype == 1)
@else
<script type="text/javascript">
    window.location = "{{ url('/') }}"
</script>
@endif
<link rel="stylesheet" href="{{ url('css/app.css') }}">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto">
{{-- @livewireStyles --}}
<style>
    span {
        font-family: Roboto;
    }

    #main-container{
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 100%; height: 100%;
    }

    #container {
        display: flex;
        align-items: center;
    }

    #text{
        display: grid;
        align-content: space-evenly;
        justify-content: end;
        align-items: center;
        justify-items: center;
        margin-right: 2rem;
    }

    #qr{
        display: flex;
    }
    div#print {
            display: none;
        }

    @media print {
        a:link:after, a:visited:after {
            content: "";
        }

        #container {
            display: flex;
            vertical-align: middle;
            align-self: baseline;
            width: 100%; height: 99%;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            border-style:double;
            border-width:2px;
            border-color: black;
        }

        #text{
            margin-right: 0;
            /* width: 100%; */
        }

        div#hid {
            display: none;
        }

        div#main-container {
            display: none;
        }

        div#print {
            display: flex;
            vertical-align: middle;
            align-self: baseline;
            width: 100%; height: 99%;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            border-style:double;
            border-width:2px;
            border-color: black;
        }
    }

    /* button {
        padding: 0.5rem;
    } */
</style>
<body>
    <div id="main-container">
        <div id="container">
            <div id="text">
                <img src="{{url('/img/spacs2.svg')}}" style="height:14rem"/>
                <span style="font-size: 3.5rem;" class=" text">{{$data->cp_name}}</span>
                <span style="font-size: 1.5rem;">{{$data->cp_desc}}</span>
                {{-- <span style="margin-bottom: 1rem; padding: 1rem; border-style:solid; border-width:2px; border-color: black;"> --}}
                <br>
            </div>
            <div id="QR">
                <span style="margin-bottom: 1rem; padding: 1rem;">
                    {{ QrCode::size(310)->generate($data->cp_data); }}
                    {{-- {{ QrCode::size(400)->gradient(0,0,0,99,81,207,'diagonal')->generate($data->cp_data); }} --}}
                </span>
            </div>
        </div>
        <div id="hid">
            <button onclick="document.title='QR Code - \'{{$data->cp_name}}\' ({{$data->cp_desc}})'; window.print(); return false;"
                class="inline-flex items-center px-4 py-2 mr-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"
                > {{-- style="padding-right: 0.5rem" --}}
                Print QR Code
            </button>
            <button onclick="location.href = '{{url('/editcheckpoint/'.$data->id)}}';"
                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"
                >
                Go Back
            </button>
        </div>
    </div>
    <div id="print">
        <div id="text">
            <img src="{{url('/img/spacs2.svg')}}" style="height:18rem"/>
            <span style="font-size: 3rem;" class=" text">{{$data->cp_name}}</span>
            <span style="font-size: 1.5rem;">{{$data->cp_desc}}</span>
            {{-- <span style="margin-bottom: 1rem; padding: 1rem; border-style:solid; border-width:2px; border-color: black;"> --}}
            <br>
            <br>
        </div>
        <div id="QR">
            <span style="padding: 1rem; padding-right:0">
                {{ QrCode::size(400)->generate($data->cp_data); }}
                {{-- {{ QrCode::size(400)->gradient(0,0,0,99,81,207,'diagonal')->generate($data->cp_data); }} --}}
            </span>
        </div>
    </div>
</body>
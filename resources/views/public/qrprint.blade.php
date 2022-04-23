@if (Auth::user()->usertype == 1)
@else
<script type="text/javascript">
    window.location = "{{ url('/') }}"
</script>
@endif
<style>
    span {
        font-family: Roboto;
    }

    @media print {
        a:link:after, a:visited:after {
            content: "";
        }
        button {
            display: none;
        }
    }

    button {
        padding: 0.5rem;
        
    }
</style>
<div style="display: flex;  vertical-align: middle; align-self: baseline; width: 100%; height: 99%;
flex-direction: column; justify-content: center; align-items: center; border-style:double">
    <div style="display: flex;  vertical-align: middle; align-items: center; flex-direction: column;">
        <img src="{{url('/img/spacs2.svg')}}" style="height:14rem"/>
        <br>
        <span style="font-size: 3.5rem;" class=" text">{{$data->cp_name}}</span>
        <span style="font-size: 1.5rem;">{{$data->cp_desc}}</span>
        <br><br>
        <span style="margin-bottom: 1rem; padding: 1rem; border-style:solid;">
            {{ QrCode::size(400)->gradient(0,0,0,99,81,207,'diagonal')->generate($data->cp_data); }}
        </span>
    </div>
    <div style="">
        <button onclick="document.title='QR Code - \'{{$data->cp_name}}\' ({{$data->cp_desc}})'; window.print(); return false;"
            style="padding-right: 0.5rem">
            Print QR Code
        </button>
        <button onclick="history.back()" style="padding-left: 0.5rem">
            Go Back
        </button>
    </div>
</div>
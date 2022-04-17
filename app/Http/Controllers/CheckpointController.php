<?php

namespace App\Http\Controllers;

use App\Models\Checkpoint;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

// use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CheckpointController extends Controller
{
    public function list()
    {
        return view('public.addcheckpoint');
    }

    public function add(Request $req)
    {
        $checkpoint = new Checkpoint();

        $checkpoint -> id = "0";
        $checkpoint -> cp_name = $req -> cp_name;
        $checkpoint -> cp_desc = $req -> cp_desc;
        //$checkpoint -> cp_data = $req -> cp_data;
        $checkpoint -> save();

        return redirect('/checkpoint');
    }

    public function view($id){
        $user = Auth::user();
        $data = Checkpoint::find($id);
        // $qr = QrCode::size(300)->gradient(0,0,0,99,81,207,'diagonal')->generate($data->cp_data);
        return view('public.editcheckpoint', ['data' => $data, 'ses' => $user]);
    }

    public function update(Request $req){
        $data = Checkpoint::find($req->id);

        $data->cp_name = $req->cp_name;
        $data->cp_desc = $req->cp_desc;
        // $data->cp_data = $req->cp_data;

        $data->save();

        return redirect('/editcheckpoint/'.$req->id)->with('success', 'Data has been updated');
    }

    function delcp($id){
        $data = Checkpoint::find($id);

        $data->deleted = 1;

        $data->save();

        return redirect('/checkpoint');
    }

    function genqr(Request $req){
        $data = Checkpoint::find($req->id);
        $id = $data->id;

        if($data->cp_data == null){
            $data->cp_data = hash('sha512', $data->id);
            $data->save();
        }

        return redirect()->to('/editcheckpoint/'.$id)->with(['data' => $data]);
    }

    public function printQR($id) {
        $data = Checkpoint::find($id);
        // $pdf = PDF::loadView('public.qrprint', compact('data'));
        
        // return $pdf->download('Checkpoint - '.$data->cp_name.' ('.$data->cp_desc.').pdf');
        return view('public.qrprint', compact('data'));
    }

    public function restcplist(){
        $data = DB::table('checkpoints')->where('deleted', '=', 1)->orderBy('id')->paginate(10);
        // $data = DB::table('users')->orderBy('id')->cursorPaginate(10);
        return view('public.landings.restorecp', ['data' => $data]);
    }

    public function restcp($id){
        $data = Checkpoint::find($id);

        $data->deleted = 0;
        
        $data->save();

        return redirect('/restcp');
    }
}

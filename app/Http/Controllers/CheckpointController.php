<?php

namespace App\Http\Controllers;

use App\Models\Checkpoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $checkpoint -> cp_data = $req -> cp_data;
        $checkpoint -> save();

        return redirect('/checkpoint');
    }

    public function view($id){
        $user = Auth::user();
        $data = Checkpoint::find($id);
        return view('public.editcheckpoint', ['data' => $data, 'ses' => $user]);
    }

    public function update(Request $req){
        $data = Checkpoint::find($req->id);

        $data->cp_name = $req->cp_name;
        $data->cp_desc = $req->cp_desc;
        $data->cp_data = $req->cp_data;

        $data->save();

        return redirect('/checkpoint');
    }

    function delcp($id){
        $data = Checkpoint::find($id);

        $data->delete();

        return redirect('/checkpoint');
    }
}

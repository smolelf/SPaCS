<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function list()
    {
        return view('public.addclient');
    }

    public function add(Request $req)
    {
        $client = new Client();

        $client -> id = "0";
        $client -> cl_name = $req -> cl_name;
        $client -> cl_email = $req -> cl_email;
        $client -> cl_phone_no = $req -> cl_phone_no;
        $client -> cl_address = $req -> cl_address;
        $client -> save();

        return redirect('/client');
    }

    public function view($id){
        $user = Auth::user();
        $data = Client::find($id);
        return view('public.editclient', ['data' => $data, 'ses' => $user]);
    }

    public function update(Request $req){
        $data = Client::find($req->id);

        $data->cl_name = $req->cl_name;
        $data->cl_email = $req->cl_email;
        $data->cl_phone_no = $req->cl_phone_no;
        $data->cl_address = $req->cl_address;

        $data->save();

        return redirect('/client');
    }
}

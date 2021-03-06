<?php

namespace App\Http\Controllers;

use App\Models\User as ModelsUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class User extends Controller
{
    public function list()
    {
        return view('public.adduser');
    }

    public function add(Request $req)
    {   
        $chk_email = ModelsUser::where('email', '=', $req -> email)->first();
        $client = new ModelsUser();

        $pw = $req -> password;
        $cpw = $req -> password_confirmation;
        $hpw = Hash::make($pw);
        $msg_e = null;
        $msg_p = null;
        $msg_pl = null;

        if ($chk_email != null){
            $msg_e = "Email existed!";
        }

        if ($pw != $cpw){
            $msg_p = "Password mismatch!";
        }

        if (strlen($pw) < 8){
            $msg_pl = "Password must be at least 8 characters!";
        }

        if ($msg_p != null OR $msg_e != null){
            return back()->withErrors(['password' => $msg_p, 'email' => $msg_e, 'length' => $msg_pl]);
        }

        $client -> id = "0";
        $client -> name = $req -> name;
        $client -> email = $req -> email;
        $client -> password = $hpw;
        $client -> usertype = 0;
        $client -> deleted = 0;
        $client -> save();

        return redirect('/user');
    }

    public function view($id){
        $user = Auth::user();
        $data = ModelsUser::find($id);
        return view('public.edituser', ['data' => $data, 'ses' => $user]);
    }

    public function update(Request $req){
        $chk_email = ModelsUser::where('email', '=', $req -> email)
                            ->wherenotin('id', [$req -> id])
                            ->first();
        $data = ModelsUser::find($req->id);
        $msg_e = null;      //Email ERROR
        $msg_pwm = null;    //Password mismatch ERROR
        $msg_pwl = null;    //Password ERROR

        if ($chk_email != null){
            $msg_e = "Email existed!";
        }

        if ($msg_e != null){
            return back()->withErrors(['email' => $msg_e]);
        }



        $data->name = $req->name;
        $data->email = $req->email;
        $data->phone_no = $req->phone_no;
        $data->usertype = $req->usertype;

        if ($req->usertype == "0"){
            if ($req->status == null){
                $data->status = null;
            }else{
                $data->status = $req->status;
            }
        }else{
            $data->status = null;
        }

        $data->save();

        return redirect('/user');
    }

    function deluser($id){
        $data = ModelsUser::find($id);

        $hpw = Hash::make("$=+Acc0unTD3l3t3D*/-");

        $data->password = $hpw;
        $data->deleted = 1;
        $data->save();

        return redirect('/user');
    }

    public function self(){
        //$data = ModelsUser::find($id);
        return view('public.landings.show');
    }

    public function updateself(Request $req){
        $data = ModelsUser::find($req->id);
        $chk_email = ModelsUser::where('email', '=', $req -> email)
                            ->wherenotin('id', [$req -> id])
                            ->first();
        $msg_e = null;

        if ($chk_email != null){
            $msg_e = "Email existed!";
        }

        if ($msg_e != null){
            return back()->withErrors(['email' => $msg_e]);
        }

        $data->name = $req->name;
        $data->email = $req->email;
        $data->phone_no = $req->phone_no;
        //$data->status = $req->status;

        $data->save();

        return redirect('/editself')->with(['status' => 'Profile updated.']);
    }

    public function updateselfpw(Request $req){
        $data = ModelsUser::find($req->id);

        $cpw = $req -> cpw;             // Current PW
        $pw_db = $data -> password;     // Current PW from DB
        $pw = $req -> pw;               // New PW
        $cfpw = $req -> cfpw;           // Confirm PW

        $msg_pw = null;         // Error: Wrong PW
        $msg_cfpw = null;       // Error: New PW not same
        $msg_pwl = null;         // Error: PW Length

        if (Hash::check($cpw,$pw_db)){
        }else{
            $msg_pw = "Current password does not match!";
        }

        if ($pw != $cfpw){
            $msg_cfpw = "New Password does not match!";
        }

        if (strlen($pw) < 8){
            $msg_pwl = "Password must be at least 8 characters!";
        }

        if ($msg_pw != null OR $msg_cfpw != null OR $msg_pwl != null){
            return back()
            ->withErrors(['cpw' => $msg_pw, 'pw' => $msg_cfpw, 'pwl' => $msg_pwl]);
        }

        $hpw = Hash::make($pw);

        $data->password = $hpw;

        $data->save();

        return redirect('/');
    }

    function resetpw(Request $req){
        $data = ModelsUser::find($req->id);

        $data->password = Hash::make('12345678');

        $data->save();

        return redirect('/user');
    }

    public function restuserlist(){
        $data = DB::table('users')->where('deleted', '=', 1)->orderBy('id')->paginate(10);
        // $data = DB::table('users')->orderBy('id')->cursorPaginate(10);
        return view('public.landings.restoreuser', ['data' => $data]);
    }

    public function restuser($id){
        $data = ModelsUser::find($id);

        $data->password = Hash::make('12345678');
        $data->deleted = 0;

        $data->save();

        return redirect('/restuser');
    }
}

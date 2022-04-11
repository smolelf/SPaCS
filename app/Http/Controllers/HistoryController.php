<?php

namespace App\Http\Controllers;

use App\Exports\HistoryExport;
use App\Models\Checkpoint;
use App\Models\History;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class HistoryController extends Controller
{
    public function newreport()
    {
        $user = User::where('usertype', '!=', '1')
            ->orderBy('id')
            ->get();
        $cp = Checkpoint::orderBy('id')
            ->get();
        return view('public.report.newreport', ['user' => $user, 'cp' => $cp]);
        //return view('public.report.newreport');
    }

    public function export(Request $req){
        // return Excel::download(new HistoryExport, 'cp.xlsx');

        if($req->pic == "all"){
            $pic = "";
        }elseif($req->pic > 0){
            $pic = $req->pic;
        }

        if($req->cp == "all"){
            $cp = "";
        }elseif($req->cp > 0){
            $cp = $req->cp;
        }

        $range= "";
        return (new HistoryExport)->pic($pic)->cp($cp)->range($range)->download('SPACS_Report.xlsx');
    }

    public function regscan(Request $req){
        $proj = new History();

        $proj -> id = "0";
        $proj -> cp_id = $req -> cp_id;
        $proj -> user_id = $req -> user_id;
        $proj -> save();

        return redirect('/mobile/history');
    }
}

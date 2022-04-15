<?php

namespace App\Http\Controllers;

use App\Exports\ExportPdf;
use App\Exports\ExportXlsx;
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

    public function genreport(Request $req){
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

        // WHERE created_at BETWEEN "2022-04-13 00:00:00" AND "2022-04-14 00:00:00"

        if($req->date == "lastweek"){
            $start = date('Y-m-d H:i:s', strtotime('monday last week'));
            $end = date('Y-m-d H:i:s', strtotime('sunday last week'));
        }elseif($req->date == "thisweek"){
            $start = date('Y-m-d H:i:s', strtotime('monday this week'));
            $end = date('Y-m-d H:i:s', strtotime('sunday this week'));
        }elseif($req->date == "month"){
            $month = $req->mth;
            $year = $req->year;
            $start = date('Y-m-d H:i:s', strtotime('first day of '.$month.' '.$year.''));
            $end = date('Y-m-d H:i:s', strtotime('last day of '.$month.' '.$year.''));
        }elseif($req->date == "custom"){
            $start = $req->datetimestart;
            $end = $req->datetimeend;
        }

        $startf = date('Y-m-d', strtotime($start));
        $endf = date('Y-m-d', strtotime($end));

        //$range= "";

        if($req->format == "xlsx"){
            return (new ExportXlsx)->pic($pic)->cp($cp)->range($start,$end)->download('SPACS Report ('.$startf.' to '.$endf.').xlsx', \Maatwebsite\Excel\Excel::XLSX);
        }elseif($req->format == "pdf"){
            return (new ExportPdf)->pic($pic)->cp($cp)->range($start,$end)->download('SPACS Report ('.$startf.' to '.$endf.').pdf', \Maatwebsite\Excel\Excel::MPDF);
        }
        // return (new HistoryExport)->pic($pic)->cp($cp)->range($range)->download('SPACS_Report.xlsx', \Maatwebsite\Excel\Excel::XLSX);
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

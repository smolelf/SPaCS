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

    public function export(){
        // return Excel::download(new HistoryExport, 'cp.xlsx');
        $pic = "";
        $cp = "";
        $range= "";
        return (new HistoryExport)->pic($pic)->cp($cp)->range($range)->download('SPACS_Report.xlsx');
    }
}

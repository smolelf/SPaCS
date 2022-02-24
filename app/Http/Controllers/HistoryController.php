<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function newreport()
    {
        // $user = Auth::user();
        // $lect = History::where('usertype', '!=', '1')->get();
        // return view('public.report.newreport', ['lect' => $lect, 'ses' => $user]);
        return view('public.report.newreport');
    }
}

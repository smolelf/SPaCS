<?php

namespace App\Http\Controllers;

use App\Models\Checkpoint;
use App\Models\Client;
use App\Models\History;
use App\Models\Project;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function home(){
        return view('public.home');
    }

    public function project(){
        $user = Auth::user();
        if ($user['usertype'] == 1){
            $cons = DB::table('projects')
                ->leftJoin('users','projects.leader','=','users.id')
                ->leftJoin('proj_statuses','projects.proj_status','=','proj_statuses.id')
                ->leftJoin('proj_stages','projects.proj_stage','=','proj_stages.id')
                ->where('proj_type', '=', '0')
                ->select('projects.*','users.name','proj_statuses.stat_desc AS stat','proj_stages.stage_desc AS stage')
                ->get();
        }else{
            $cons = DB::table('projects')
                ->leftJoin('users','projects.leader','=','users.id')
                ->leftJoin('proj_statuses','projects.proj_status','=','proj_statuses.id')
                ->leftJoin('proj_stages','projects.proj_stage','=','proj_stages.id')
                ->where('projects.leader', '=', $user['id'])
                ->where('proj_type', '=', '0')
                ->select('projects.*','users.name','proj_statuses.stat_desc AS stat','proj_stages.stage_desc AS stage')
                ->get();
        }

        if ($user['usertype'] == 1){
            $rsch = DB::table('projects')
                ->leftJoin('users','projects.leader','=','users.id')
                ->leftJoin('proj_statuses','projects.proj_status','=','proj_statuses.id')
                ->leftJoin('proj_stages','projects.proj_stage','=','proj_stages.id')
                ->where('proj_type', '=', '1')
                ->select('projects.*','users.name','proj_statuses.stat_desc AS stat','proj_stages.stage_desc AS stage')
                ->get();
        }else{
            $rsch = DB::table('projects')
                ->leftJoin('users','projects.leader','=','users.id')
                ->leftJoin('proj_statuses','projects.proj_status','=','proj_statuses.id')
                ->leftJoin('proj_stages','projects.proj_stage','=','proj_stages.id')
                ->where('projects.leader', '=', $user['id'])
                ->where('proj_type', '=', '1')
                ->select('projects.*','users.name','proj_statuses.stat_desc AS stat','proj_stages.stage_desc AS stage')
                ->get();
        }

        return view('public.landings.projects', ['cons' => $cons, 'rsch' => $rsch]);
    }

    public function history(){
        $user = Auth::user();
        // $data = History::all();
        $data = DB::table('histories')
        ->leftJoin('users','histories.user_id','=','users.id')
        ->leftJoin('checkpoints','histories.cp_id','=','checkpoints.id')
        ->select('histories.*','users.name','checkpoints.cp_name','checkpoints.cp_desc')
        ->orderBy('histories.id')
        ->get();
        return view('public.landings.histories', ['data' => $data]);
    }

    public function user(){
        $user = Auth::user();
        $data = DB::table('users')->orderBy('id')->paginate(10);
        return view('public.landings.users', ['data' => $data]);
    }

    public function client(){
        $user = Auth::user();
        $data = Client::where('id', '!=', '1')->orderBy('id')->get();
        return view('public.landings.clients', ['data' => $data]);
    }

    public function checkpoint(){
        $user = Auth::user();
        $data = DB::table('checkpoints')->orderBy('id')->get();
        return view('public.landings.checkpoints', ['data' => $data]);
    }

    public function htsearch(Request $req)
    {
        $searchby = $req->searchby;
        $init1 = $req->search;
        $init2 = $req->add_search;
        if($searchby == 'cp'){
            $data = DB::table('histories')
                ->leftJoin('users','histories.user_id','=','users.id')
                ->leftJoin('checkpoints','histories.cp_id','=','checkpoints.id')
                ->select('histories.*','users.name','checkpoints.cp_name','checkpoints.cp_desc')
                ->where('cp_name', 'like', '%'.$req->input('search').'%')
                ->orderBy('histories.id')
                ->get();
            return view('public.landings.histories', ['data' => $data, 'searchby' => $searchby, 'init1' => $init1, 'init2' => $init2]);
        }else if($searchby == "pic"){
            $data = DB::table('histories')
                ->leftJoin('users','histories.user_id','=','users.id')
                ->leftJoin('checkpoints','histories.cp_id','=','checkpoints.id')
                ->select('histories.*','users.name','checkpoints.cp_name','checkpoints.cp_desc')
                ->where('name', 'like', '%'.$req->input('search').'%')
                ->orderBy('histories.id')
                ->get();
            return view('public.landings.histories', ['data' => $data, 'searchby' => $searchby, 'init1' => $init1, 'init2' => $init2]);
        }else if($searchby == "datetime"){
            $data = DB::table('histories')
                ->leftJoin('users','histories.user_id','=','users.id')
                ->leftJoin('checkpoints','histories.cp_id','=','checkpoints.id')
                ->select('histories.*','users.name','checkpoints.cp_name','checkpoints.cp_desc')
                ->whereBetween('histories.created_at', [$req->input('add_search'), $req->input('search')])
                ->orderBy('histories.id')
                ->get();
            return view('public.landings.histories', ['data' => $data, 'searchby' => $searchby, 'init1' => $init1, 'init2' => $init2]);
        }
    }

    public function ussearch(Request $req)
    {
        $searchby = $req->searchby;
        $init = $req->search;

        if($searchby == 'name'){
            $data = DB::table('users')
                ->where('name', 'like', '%'.$req->input('search').'%')
                ->orderBy('id')
                ->paginate(10);
            return view('public.landings.users', ['data' => $data, 'init' => $init, 'searchby' => $searchby]);
        }else if($searchby == "phone"){
            $data = DB::table('users')
                ->where('phone_no', 'like', '%'.$req->input('search').'%')
                ->orderBy('id')
                ->paginate(10);
            return view('public.landings.users', ['data' => $data, 'init' => $init, 'searchby' => $searchby]);
        }else if($searchby == "dept"){
            $data = DB::table('users')
                ->where('dept', 'like', '%'.$req->input('search').'%')
                ->orderBy('id')
                ->paginate(10);
            return view('public.landings.users', ['data' => $data, 'init' => $init, 'searchby' => $searchby]);
        }
    }

    public function cpsearch(Request $req)
    {
        $searchby = $req->searchby;
        $init = $req->search;

        if($searchby == 'name'){
            $data = DB::table('checkpoints')
                ->where('cp_name', 'like', '%'.$req->input('search').'%')
                ->orderBy('id')
                ->get();
            return view('public.landings.checkpoints', ['data' => $data, 'init' => $init, 'searchby' => $searchby]);
        }else if($searchby == "desc"){
            $data = DB::table('checkpoints')
                ->where('cp_desc', 'like', '%'.$req->input('search').'%')
                ->orderBy('id')
                ->get();
            return view('public.landings.checkpoints', ['data' => $data, 'init' => $init, 'searchby' => $searchby]);
        }
    }

    public function mobilehistory(){
        $data = DB::table('histories')
        ->leftJoin('users','histories.user_id','=','users.id')
        ->leftJoin('checkpoints','histories.cp_id','=','checkpoints.id')
        ->select('histories.*','users.name','checkpoints.cp_name','checkpoints.cp_desc')
        ->where('histories.user_id', '=', Auth::user()->id)
        ->orderBy('histories.id')
        ->get();
        return view('public.landings.mobile.histories', ['data' => $data]);
    }

    public function scanqr(){
        return view('public.landings.mobile.scanqr');
    }

}

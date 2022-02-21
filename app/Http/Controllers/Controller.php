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
        $data = User::all();
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
}

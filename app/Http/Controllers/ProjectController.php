<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Project;
use App\Models\ProjStages;
use App\Models\ProjStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    public function list()
    {
        $user = Auth::user();
        $lect = User::where('usertype', '!=', '1')->get();
        return view('public.addproject', ['lect' => $lect, 'ses' => $user]);
    }

    public function add(Request $req)
    {
        $proj = new Project();

        $proj -> id = "0";
        $proj -> proj_name = $req -> proj_name;
        $proj -> leader = $req -> leader;
        $proj -> proj_stage = "1";
        $proj -> proj_status = "1";
        $proj -> proj_mem_num = "0";
        $proj -> proj_type = $req -> proj_type;
        $proj -> save();

        return redirect('/project');
    }

    public function view($id)
    {
        $user = Auth::user();
        $stage = ProjStages::all();
        $stat = ProjStatus::all();
        $client = Client::orderBy('id')->get();
        // $data = Project::find($id);
        $data = DB::table('projects')
        ->leftJoin('users','projects.leader','=','users.id')
        ->leftJoin('clients','projects.client','=','clients.id')
        ->leftJoin('proj_stages','projects.proj_stage','=','proj_stages.id')
        ->leftJoin('proj_statuses','projects.proj_status','=','proj_statuses.id')
        ->where('projects.id', '=', $id)
        ->select('projects.*','users.name', 'proj_stages.stage_desc', 'proj_statuses.stat_desc','clients.cl_name')
        ->first();
        return view('public.editproject', ['data' => $data, 'ses' => $user, 'stage' => $stage, 'stat' => $stat, 'client' => $client, 'val' => '0']);
    }

    public function update(Request $req){
        $data = Project::find($req->id);

        $mem_cnt = $req->proj_mem_num;
        if ($mem_cnt == null OR $mem_cnt == "0"){
            $data->proj_mem_num1 = null;
            $data->proj_mem_num2 = null;
            $data->proj_mem_num3 = null;
        }elseif ($mem_cnt == "1"){
            $data->proj_mem_num2 = null;
            $data->proj_mem_num3 = null;
        }elseif ($mem_cnt == "2"){
            $data->proj_mem_num3 = null;
        }

        $data->proj_name = $req->proj_name;
        $data->leader = $req->leader;
        $data->proj_type = $req->proj_type;
        $data->proj_mem_num = $req->proj_mem_num;
        $data->start_date = $req->start_date;
        $data->end_date = $req->end_date;
        $data->duration = $req->duration;
        $data->cost = $req->cost;
        $data->client = $req->client;
        $data->proj_stage = $req->proj_stage;
        $data->proj_status = $req->proj_status;

        $data->save();

        return redirect('/project');
    }
}

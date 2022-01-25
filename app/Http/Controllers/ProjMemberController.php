<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProjMemberController extends Controller
{
    public function view($id)
    {
        $user = Auth::user();
        $data = DB::table('projects')
        ->where('projects.id', '=', $id)
        ->first();
        $lect = User::where('id', '!=', '1')->where('id', '!=', $data->leader)->get();
        return view('public.editmember', ['data' => $data, 'ses' => $user, 'lect' => $lect, 'proj_id' => $id]);
    }

    public function update(Request $req){
        $data = Project::find($req->id);

        $data->proj_mem_num1 = $req->proj_mem_num1;
        $data->proj_mem_num2 = $req->proj_mem_num2;
        $data->proj_mem_num3 = $req->proj_mem_num3;

        $data->save();

        return redirect('/project');
    }
}

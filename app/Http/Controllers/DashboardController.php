<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\ClientModule\Entities\Client;
use DB;

class DashboardController extends Controller
{
    /** 
     * This function gets the dashboard
    */
    protected function getDashboard(){
        $get_users_town =DB::table('clients')->join('users','clients.user_id','clients.id')
        ->join('towns','clients.town_id','towns.id')
        ->where('clients.user_id','=',3)
        ->where('clients.deleted_at',null)
        ->select('clients.*','towns.town')->get();
        if(in_array('Can view Dashboard', auth()->user()->getUserPermisions())){
       return view('admin.dashboard',compact('get_users_town'));
        }else{
            return redirect('/clientmodule/');
        }
    }
}

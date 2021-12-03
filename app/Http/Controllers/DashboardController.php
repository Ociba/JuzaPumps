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
        if(auth()->user()->category =='admin'){
         return view('admin.dashboard', compact('get_users_town'));
        }elseif(auth()->user()->category =='staff'){
            return redirect('/clientmodule/');
        }else{
            return redirect('/fuelstation/search-client/');
        }
    }
}

<?php

namespace Modules\FuelStation\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use DB;
Use Auth;
use Carbon\Carbon;

class ReportController extends Controller
{
    
    /**
     * This function gets todays revenue
     */
    public function todayRevenue()
    {
        $get_todays_revenue =DB::table('fuel_stations')->join('users','fuel_stations.user_id','users.id')
        ->join('clients','fuel_stations.client_id','clients.id')
        ->where('fuel_stations.created_at','>=',Carbon::today())
        ->whereNotnull('fuel_stations.amount_paid')
        ->where('fuel_stations.user_id',auth()->user()->id)
        ->select('clients.*','fuel_stations.amount_paid')
        ->simplePaginate(10);
        //get sum of money collected today
        $amount_paid_today= DB::table('fuel_stations')->where('created_at','>=',Carbon::today())->where('fuel_stations.user_id',auth()->user()->id)->sum('amount_paid');
        return view('fuelstation::todays_revenue', compact('get_todays_revenue','amount_paid_today'));
    }
    /** 
     * This function gets all revenue
     *search using data range
   */
    protected function getRevenue(){
    $get_all_client_payments =DB::table('fuel_stations')->join('users','fuel_stations.user_id','users.id')
    ->join('clients','fuel_stations.client_id','clients.id')
    ->whereNotnull('fuel_stations.amount_paid')
    ->where('fuel_stations.user_id',auth()->user()->id)
    ->select('clients.*','fuel_stations.amount_paid','fuel_stations.created_at')
    ->simplePaginate(10);
    //get sum of money collected
    $get_total_revenue_collected= DB::table('fuel_stations')->where('fuel_stations.user_id',auth()->user()->id)->sum('amount_paid');
    return view('fuelstation::revenue',compact('get_all_client_payments','get_total_revenue_collected'));
  }

   /** 
    * This function gets all clients with pending debts
   */
  protected function getPendingClients(){
    $charge = \DB::table('charges')->where('status','pending')->where('charges.fuel_station_id',auth()->user()->id)->sum('charge');
    $debts = \DB::table('fuel_stations')->where('status','pending')->where('fuel_stations.user_id',auth()->user()->id)->sum('debt');
    $total_debt = $charge + $debts;

    $get_all_client_with_pending_payments =DB::table('fuel_stations')->join('users','fuel_stations.user_id','users.id')
    ->join('clients','fuel_stations.client_id','clients.id')
    ->whereNotNull('fuel_stations.debt')
    ->where('fuel_stations.status','pending')
    ->where('fuel_stations.user_id',auth()->user()->id)
    ->select('clients.*','fuel_stations.debt','users.name','fuel_stations.created_at')
    ->simplePaginate(10);
    return view('fuelstation::pending_debts',compact('get_all_client_with_pending_payments','total_debt')); 
  }

    /** 
    * This function gets all clients with overdue debts
   */
  protected function getOverdueClients(){

    $get_all_client_with_overdue_payments =DB::table('fuel_stations')->join('users','fuel_stations.user_id','users.id')
    ->join('clients','fuel_stations.client_id','clients.id')
    ->whereNotNull('fuel_stations.debt')
    ->where('fuel_stations.status','pending')
    ->where('fuel_stations.user_id',auth()->user()->id)
    ->where('fuel_stations.days','>=','')
    ->select('clients.*','fuel_stations.debt','users.name','fuel_stations.created_at')
    ->simplePaginate(10);
    return view('fuelstation::overdue',compact('get_all_client_with_overdue_payments'));
  }
}

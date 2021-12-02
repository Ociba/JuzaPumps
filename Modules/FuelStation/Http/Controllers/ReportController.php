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
    $get_all_client_payments =DB::table('charges')->join('users','charges.fuel_station_id','users.id')
    ->join('clients','charges.client_id','clients.id')
    ->where('charges.status','paid')
    ->where('charges.fuel_station_id',auth()->user()->id)
    ->select('clients.*','charges.charge','charges.created_at')
    ->simplePaginate(10);
    //get sum of money collected
    $get_total_revenue_collected= DB::table('charges')->join('users','charges.fuel_station_id','users.id')->where('charges.status','paid')->where('charges.fuel_station_id',auth()->user()->id)->sum('charge');
    return view('fuelstation::revenue',compact('get_all_client_payments','get_total_revenue_collected'));
  }

   /** 
    * This function gets all clients with pending debts
   */
  protected function getPendingClients(){
    $charge = \DB::table('charges')->where('status','pending')->where('charges.fuel_station_id',auth()->user()->id)->sum('charge');

    $get_all_client_with_pending_payments =DB::table('charges')->join('users','charges.fuel_station_id','users.id')
    ->join('clients','charges.client_id','clients.id')
    ->where('charges.status','pending')
    ->where('charges.fuel_station_id',auth()->user()->id)
    ->select('clients.*','charges.charge','charges.days','charges.created_at')
    ->simplePaginate(10);
    return view('fuelstation::pending_debts',compact('get_all_client_with_pending_payments','charge')); 
  }

    /** 
    * This function gets all clients with overdue debts
   */
  protected function getOverdueClients(){
    $overdue_amount =DB::table('charges')->where('charges.status','pending')->where('charges.created_at', '<', Carbon::now()->subDays(30))
    ->where('charges.fuel_station_id',auth()->user()->id)->sum('charge');
    $get_all_client_with_overdue_payments =DB::table('charges')->join('users','charges.fuel_station_id','users.id')
    ->join('clients','charges.client_id','clients.id')
    ->where('charges.status','pending')
    ->where('charges.created_at', '<', Carbon::now()->subDays(30))
    ->where('charges.fuel_station_id',auth()->user()->id)
    ->select('clients.*','charges.charge','charges.days','charges.created_at')
    ->simplePaginate(10);
    return view('fuelstation::overdue',compact('get_all_client_with_overdue_payments','overdue_amount'));
  }
}

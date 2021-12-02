<?php

namespace Modules\ClientModule\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use DB;
Use Auth;
use Carbon\Carbon;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function todaysRevenueReport()
    {
        $get_todays_revenue =DB::table('charges')->join('users','charges.fuel_station_id','users.id')
        ->join('clients','charges.client_id','clients.id')
        ->where('charges.status','paid')
        ->where('charges.created_at','>=',Carbon::today())
        ->where('clients.user_id',auth()->user()->id)        
        ->select('clients.*','charges.charge','charges.created_at')
        ->simplePaginate(10);
        return view('clientmodule::todays_revenue', compact('get_todays_revenue'));
    }
    /** 
     * This function gets all daily transactions revenue report
    */
    protected function dailyRevenueReport(){
        $daily_revenue =DB::table('charges')->join('users','charges.fuel_station_id','users.id')
        ->join('clients','charges.client_id','clients.id')
        ->where('charges.status','paid')
        ->where('clients.user_id',auth()->user()->id)        
        ->select('clients.*','charges.charge','charges.created_at')
        ->simplePaginate(10);
        return view('clientmodule::daily_revenue', compact('daily_revenue'));
    }
     /** 
     * This function gets all daily transactions revenue report
    */
    protected function DateRangeReport(){
        $daily_revenue =DB::table('charges')->join('users','charges.fuel_station_id','users.id')
        ->join('clients','charges.client_id','clients.id')
        ->where('charges.status','paid')
        ->where('clients.user_id',auth()->user()->id)        
        ->select('clients.*','charges.charge','charges.created_at')
        ->simplePaginate(10);
        return view('clientmodule::date_range_revenue', compact('daily_revenue'));
    }
    /** 
     * This function gets date range revenue
    */
    protected function searchByDate(){
        $daily_revenue =DB::table('charges')->join('users','charges.fuel_station_id','users.id')
        ->join('clients','charges.client_id','clients.id')
        ->where('charges.status','paid')
        ->whereBetween('charges.created_at', [request()->from_date, request()->to_date])
        ->where('clients.user_id',auth()->user()->id)        
        ->select('clients.*','charges.charge','charges.created_at')
        ->simplePaginate(10);
        return view('clientmodule::date_range_revenue', compact('daily_revenue'));
    }
}

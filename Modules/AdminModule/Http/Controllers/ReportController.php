<?php

namespace Modules\AdminModule\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use DB;
class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function searchByDate()
    {
        $get_all_client_payments =DB::table('charges')
        ->join('clients','charges.client_id','clients.id')
        ->whereBetween('charges.created_at', [request()->from_date, request()->to_date])
        ->where('charges.status','paid')
        ->select('clients.*','charges.charge','charges.created_at')->simplePaginate(10);
        //get sum of money collected
       $get_total_revenue_collected= DB::table('charges')->where('status','paid')->sum('charge');
        return view('adminmodule::revenue',compact('get_all_client_payments','get_total_revenue_collected'));
    }

     /**
     * Display all transactions.
     */
    public function ReportSpecificDate()
    {
        $get_transaction =DB::table('charges')->join('users','charges.fuel_station_id','users.id')
        ->join('clients','charges.client_id','clients.id')
        ->select('users.name','clients.*','charges.*','charges.created_at')->simplePaginate(10);
        return view('adminmodule::specific_date_report', compact('get_transaction'));
    }

    /** 
     * This function searches by specific date
    */
    protected function searchReportSpecificDate(){
        $get_transaction =DB::table('charges')->join('users','charges.fuel_station_id','users.id')
        ->join('clients','charges.client_id','clients.id')
        ->whereDate('charges.created_at',request()->created_at)
        ->select('users.name','clients.*','charges.*','charges.created_at')->simplePaginate(10);
        return view('adminmodule::specific_date_report', compact('get_transaction'));
    }
    /** 
     * This function gets all transactions search by date range
    */
    public function reportDateRange()
    {
        $get_transaction =DB::table('charges')->join('users','charges.fuel_station_id','users.id')
        ->join('clients','charges.client_id','clients.id')
        ->select('users.name','clients.*','charges.*','charges.created_at')->simplePaginate(10);
        return view('adminmodule::date_range_report', compact('get_transaction'));
    }
      /** 
     * This function search transaction basing on the days
    */
    public function searchReportByDate()
    {
        $get_transaction=DB::table('charges')->join('users','charges.fuel_station_id','users.id')
        ->join('clients','charges.client_id','clients.id')
        ->whereBetween('charges.created_at', [request()->from_date, request()->to_date])
        ->select('users.name','clients.*','charges.*','charges.created_at')->simplePaginate(10);
        return view('adminmodule::date_range_report',compact('get_transaction'));
    }    
}

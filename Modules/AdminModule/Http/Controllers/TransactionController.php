<?php

namespace Modules\AdminModule\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use DB;
use Auth;

class TransactionController extends Controller
{
    /**
     * Display all transactions.
     */
    public function specificDate()
    {
        $get_transaction =DB::table('fuel_stations')->join('users','fuel_stations.user_id','users.id')
        ->join('clients','fuel_stations.client_id','clients.id')
        ->select('users.name','clients.*','fuel_stations.*','fuel_stations.created_at')->simplePaginate(10);
        return view('adminmodule::specific_date', compact('get_transaction'));
    }

    /** 
     * This function searches by specific date
    */
    protected function searchSpecificDate(){
        $get_transaction =DB::table('fuel_stations')->join('users','fuel_stations.user_id','users.id')
        ->join('clients','fuel_stations.client_id','clients.id')
        ->whereDate('fuel_stations.created_at',request()->created_at)
        ->select('users.name','clients.*','fuel_stations.*','fuel_stations.created_at')->simplePaginate(10);
        return view('adminmodule::specific_date', compact('get_transaction'));
    }
    /** 
     * This function gets all transactions search by date range
    */
    public function dateRange()
    {
        $get_transaction =DB::table('fuel_stations')->join('users','fuel_stations.user_id','users.id')
        ->join('clients','fuel_stations.client_id','clients.id')
        ->select('users.name','clients.*','fuel_stations.*','fuel_stations.created_at')->simplePaginate(10);
        return view('adminmodule::date_range_transactions', compact('get_transaction'));
    }
      /** 
     * This function search transaction basing on the days
    */
    public function searchByDate()
    {
        $get_transaction=DB::table('fuel_stations')->join('clients','fuel_stations.client_id','clients.id')
        ->join('users','fuel_stations.user_id','users.id')
        ->whereBetween('fuel_stations.created_at', [request()->from_date, request()->to_date])
        ->select('clients.*','users.name','fuel_stations.*')->simplePaginate(10);
        return view('adminmodule::date_range_transactions',compact('get_transaction'));
    }
}

<?php

namespace Modules\ClientModule\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use DB;
use Carbon\Carbon;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('clientmodule::index');
    }

    /**
     * This function gets todays debts
     */
    protected function todaysTransactions()
        
    {

        $get_all_todays_debts=DB::table('fuel_stations')->join('clients','fuel_stations.client_id','clients.id')
        ->join('users','fuel_stations.user_id','users.id')
        ->where('fuel_stations.status','pending')
        ->whereNotNull('fuel_stations.debt')
        ->where('fuel_stations.created_at','>=',Carbon::today())
        ->where('clients.user_id',auth()->user()->id)
        ->select('clients.*','users.name','fuel_stations.*')->simplePaginate(10);
        return view('clientmodule::todays_transactions',compact('get_all_todays_debts'));
    }
   /** 
     * This function gets all todays payment
    */
    protected function dailyTransactions()
    {
        $get_all_transactions=DB::table('fuel_stations')->join('clients','fuel_stations.client_id','clients.id')
        ->join('users','fuel_stations.user_id','users.id')
        ->where('clients.user_id',auth()->user()->id)
        ->select('clients.*','users.name','fuel_stations.*')->simplePaginate(10);
        return view('clientmodule::all_transactions',compact('get_all_transactions'));
    }

   /**
     * This function gets all debts
     */
    protected function DateRangeTransactions()
        
    {

        $get_all_transactions=DB::table('fuel_stations')->join('clients','fuel_stations.client_id','clients.id')
        ->join('users','fuel_stations.user_id','users.id')
        ->where('clients.user_id',auth()->user()->id)
        ->select('clients.*','users.name','fuel_stations.*')->simplePaginate(10);
        return view('clientmodule::date_range_transactions',compact('get_all_transactions'));
    }
    /** 
     * This function search transaction basing on the days
    */
    public function searchByDate()
    {
        $get_all_transactions=DB::table('fuel_stations')->join('clients','fuel_stations.client_id','clients.id')
        ->join('users','fuel_stations.user_id','users.id')
        ->whereBetween('fuel_stations.created_at', [request()->from_date, request()->to_date])
        ->where('clients.user_id',auth()->user()->id)
        ->select('clients.*','users.name','fuel_stations.*')->simplePaginate(10);
        return view('clientmodule::date_range_transactions',compact('get_all_transactions'));
    }
    /** 
     * This function shows list of debtors
    */
    protected function listOfDebtors(){
        $list_of_debtors =DB::table('fuel_stations')->join('clients','fuel_stations.client_id','clients.id')
        ->join('users','fuel_stations.user_id','users.id')
        ->where('fuel_stations.status','pending')
        ->where('clients.user_id',auth()->user()->id)
        ->select('clients.*','users.name','fuel_stations.*')->simplePaginate(10);
        return view('clientmodule::debtors',compact('list_of_debtors'));
    }
}

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
    protected function todaysDebts()
        
    {

        $get_all_todays_debts=DB::table('fuel_stations')->join('clients','fuel_stations.client_id','clients.id')
        ->join('users','fuel_stations.user_id','users.id')
        ->where('fuel_stations.status','pending')
        ->whereNotNull('fuel_stations.debt')
        ->where('fuel_stations.created_at','>=',Carbon::today())
        ->where('clients.user_id',auth()->user()->id)
        ->select('clients.*','users.name','fuel_stations.*')->simplePaginate(10);
        return view('clientmodule::todays_debts',compact('get_all_todays_debts'));
    }
   /** 
     * This function gets all todays payment
    */
    protected function todaysPayments()
    {
        $get_all_todays_payments=DB::table('fuel_stations')->join('clients','fuel_stations.client_id','clients.id')
        ->join('users','fuel_stations.user_id','users.id')
        ->where('fuel_stations.status','paid')
        ->whereNotNull('fuel_stations.amount_paid')
        ->where('fuel_stations.created_at','>=',Carbon::today())
        ->where('clients.user_id',auth()->user()->id)
        ->select('clients.*','users.name','fuel_stations.*')->simplePaginate(10);
        return view('clientmodule::todays_payments',compact('get_all_todays_payments'));
    }

   /**
     * This function gets all debts
     */
    protected function allDebts()
        
    {

        $get_all_debts=DB::table('fuel_stations')->join('clients','fuel_stations.client_id','clients.id')
        ->join('users','fuel_stations.user_id','users.id')
        ->where('fuel_stations.status','pending')
        ->whereNotNull('fuel_stations.debt')
        ->where('clients.user_id',auth()->user()->id)
        ->select('clients.*','users.name','fuel_stations.*')->simplePaginate(10);
        return view('clientmodule::all_debts',compact('get_all_debts'));
    }

   /** 
     * This function gets all payment
    */
    protected function allPayments()
    {
        $get_all_payments=DB::table('fuel_stations')->join('clients','fuel_stations.client_id','clients.id')
        ->join('users','fuel_stations.user_id','users.id')
        ->where('fuel_stations.status','paid')
        ->whereNotNull('fuel_stations.amount_paid')
        ->where('clients.user_id',auth()->user()->id)
        ->select('clients.*','users.name','fuel_stations.*')->simplePaginate(10);
        return view('clientmodule::all_payments',compact('get_all_payments'));
    }

    /** 
     * This function gets all overdue
    */
    protected function overdue()
    {
        $overdue_debts=DB::table('fuel_stations')->join('clients','fuel_stations.client_id','clients.id')
        ->join('users','fuel_stations.user_id','users.id')
        ->where('fuel_stations.status','paid')
        ->whereNotNull('fuel_stations.amount_paid')
        ->where('clients.user_id',auth()->user()->id)
        ->where('fuel_stations.created_at', '<', Carbon::now()->subDays(30))
        ->select('clients.*','users.name','fuel_stations.*')->simplePaginate(10);
        return view('clientmodule::overdue',compact('overdue_debts'));
    }
}

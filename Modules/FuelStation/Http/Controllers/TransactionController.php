<?php

namespace Modules\FuelStation\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use DB;
use Carbon\Carbon;

class TransactionController extends Controller
{
    /**
     * This function gets todays transactions
     */
    protected function todaysTransactions()
        
    {
        
        $charge = \DB::table('charges')->where('created_at','>=',Carbon::today())->where('status','pending')->sum('charge');
        $debts = \DB::table('fuel_stations')->where('created_at','>=',Carbon::today())->where('status','pending')->sum('debt');
        $total_debt_today = $charge + $debts;

        $get_all_todays_debts=DB::table('fuel_stations')->join('clients','fuel_stations.client_id','clients.id')
        ->join('users','fuel_stations.user_id','users.id')
        //->where('fuel_stations.status','pending')
        ->where('fuel_stations.created_at','>=',Carbon::today())
        ->where('fuel_stations.user_id',auth()->user()->id)
        ->select('clients.*','users.name','fuel_stations.*')->simplePaginate(10);
        return view('fuelstation::todays_transactions',compact('get_all_todays_debts','total_debt_today'));
    }
 /** 
     * This function gets all debts
    */
    protected function allTransactions()
    {
        $charge = \DB::table('charges')->where('status','pending')->where('charges.fuel_station_id',auth()->user()->id)->sum('charge');
        $debts = \DB::table('fuel_stations')->where('status','pending')->where('fuel_stations.user_id',auth()->user()->id)->sum('debt');
        $total_debt = $charge + $debts;

        $all_transactions=DB::table('fuel_stations')->join('clients','fuel_stations.client_id','clients.id')
        ->join('users','fuel_stations.user_id','users.id')
        ->where('fuel_stations.user_id',auth()->user()->id)
        ->select('clients.*','users.name','fuel_stations.*')->simplePaginate(10);
        return view('fuelstation::all_transactions',compact('all_transactions','total_debt'));
    }
/**
     * This function gets all payments.
     */
    protected function dataRangeTransactions()
    {
        $payment = \DB::table('fuel_stations')->where('status','paid')->where('fuel_stations.user_id',auth()->user()->id)->sum('amount_paid');

        $all_transactions=DB::table('fuel_stations')->join('clients','fuel_stations.client_id','clients.id')
        ->join('users','fuel_stations.user_id','users.id')
        ->where('fuel_stations.user_id',auth()->user()->id)
        ->select('clients.*','users.name','fuel_stations.*')->simplePaginate(10);
        return view('fuelstation::data_range_transactions',compact('all_transactions','payment'));
    }
    /** 
     * This function search transaction basing on the days
    */
    public function searchByDate()
    {
        $all_transactions=DB::table('fuel_stations')->join('clients','fuel_stations.client_id','clients.id')
        ->join('users','fuel_stations.user_id','users.id')
        ->whereBetween('fuel_stations.created_at', [request()->from_date, request()->to_date])
        ->where('fuel_stations.user_id',auth()->user()->id)
        ->select('clients.*','users.name','fuel_stations.*')->simplePaginate(10);
        return view('fuelstation::data_range_transactions',compact('all_transactions'));
    }
}

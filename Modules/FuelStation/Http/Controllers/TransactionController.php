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
     * This function gets todays debts
     */
    protected function todaysDebts()
        
    {
        
        $charge = \DB::table('charges')->where('created_at','>=',Carbon::today())->where('status','pending')->sum('charge');
        $debts = \DB::table('fuel_stations')->where('created_at','>=',Carbon::today())->where('status','pending')->sum('debt');
        $total_debt_today = $charge + $debts;

        $get_all_todays_debts=DB::table('fuel_stations')->join('clients','fuel_stations.client_id','clients.id')
        ->join('users','fuel_stations.user_id','users.id')
        ->where('fuel_stations.status','pending')
        ->where('fuel_stations.created_at','>=',Carbon::today())
        ->where('fuel_stations.user_id',auth()->user()->id)
        ->select('clients.*','users.name','fuel_stations.*')->simplePaginate(10);
        return view('fuelstation::todays_debts',compact('get_all_todays_debts','total_debt_today'));
    }

     /** 
     * This function gets all todays payment
    */
    protected function todaysPayments()
    {
        $todays_payment = \DB::table('fuel_stations')->where('created_at','>=',Carbon::today())->where('status','paid')->sum('amount_paid');

        $get_all_todays_payments=DB::table('fuel_stations')->join('clients','fuel_stations.client_id','clients.id')
        ->join('users','fuel_stations.user_id','users.id')
        ->where('fuel_stations.status','paid')
        ->whereNotNull('fuel_stations.amount_paid')
        ->where('fuel_stations.created_at','>=',Carbon::today())
        ->where('fuel_stations.user_id',auth()->user()->id)
        ->select('clients.*','users.name','fuel_stations.*')->simplePaginate(10);
        return view('fuelstation::todays_payments',compact('get_all_todays_payments','todays_payment'));
    }

 /** 
     * This function gets all debts
    */
    protected function allDebts()
    {
        $charge = \DB::table('charges')->where('status','pending')->where('charges.fuel_station_id',auth()->user()->id)->sum('charge');
        $debts = \DB::table('fuel_stations')->where('status','pending')->where('fuel_stations.user_id',auth()->user()->id)->sum('debt');
        $total_debt = $charge + $debts;

        $all_debts=DB::table('fuel_stations')->join('clients','fuel_stations.client_id','clients.id')
        ->join('users','fuel_stations.user_id','users.id')
        ->where('fuel_stations.status','pending')
        ->where('fuel_stations.user_id',auth()->user()->id)
        ->select('clients.*','users.name','fuel_stations.*')->simplePaginate(10);
        return view('fuelstation::all_debts',compact('all_debts','total_debt'));
    }
/**
     * This function gets all payments.
     */
    protected function allPayments()
    {
        $payment = \DB::table('fuel_stations')->where('status','paid')->where('fuel_stations.user_id',auth()->user()->id)->sum('amount_paid');

        $all_todays_payments=DB::table('fuel_stations')->join('clients','fuel_stations.client_id','clients.id')
        ->join('users','fuel_stations.user_id','users.id')
        ->whereNotNull('fuel_stations.amount_paid')
        ->where('fuel_stations.status','paid')
        ->where('fuel_stations.user_id',auth()->user()->id)
        ->select('clients.*','users.name','fuel_stations.*')->simplePaginate(10);
        return view('fuelstation::all_payments',compact('all_todays_payments','payment'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('fuelstation::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}

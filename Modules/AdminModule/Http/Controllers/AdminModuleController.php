<?php

namespace Modules\AdminModule\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AdminModule\Entities\InitialFloat;
use DB;
use Auth;
use Carbon\Carbon;

class AdminModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('adminmodule::index');
    }
     /** 
      * This function gets registered fuel stations
     */
    public function getFuelStations(){
        $get_fuel_stations =DB::table('users')->where('category','fuel_station')->simplePaginate(10);
        return view('adminmodule::fuel_station', compact('get_fuel_stations'));
    }
    /** 
     * This function gets form for depositing money to petrol station
    */
    protected function depositFloatMoneyForm($user_id){
        $deposit_money=InitialFloat::where('id',$user_id)->get();
        return view('adminmodule::deposit_fuelstation_money_form', compact('deposit_money'));
    }
    /** 
     * This function gets all initial deposits per station
    */
    protected function initialDeposits(){
        $get_all_initial_deposits_per_station =InitialFloat::join('users','initial_floats.fuel_station_id','users.id')
        ->simplePaginate(10);
        return view('adminmodule::initial_deposit', compact('get_all_initial_deposits_per_station'));
    }
  /** 
   * This function deposits money to the petrol station
  */
  protected function depositMoney(){
      $initial_deposit =new InitialFloat;
      $initial_deposit->user_id         =Auth::user()->id;
      $initial_deposit->float           =request()->float;
      $initial_deposit->fuel_station_id =request()->fuel_station_id;
      $initial_deposit->save();
      return redirect()->back()->with('msg','Operation Successfull');
  }
    /** 
     * This function deletes fuelstation
    */
    protected function deleteFuelStation($user_id){
        User::where('id',$user_id)->delete();
        return redirect()->back()->with('msg','Operation Successful');
    }
    /** 
     * This function gets all districts of operarations
    */
    protected function getTowns(){
        $get_all_towns =DB::table('clients')->join('towns','clients.town_id','towns.id')
        ->select('towns.*')
        ->distinct('town')
        ->simplePaginate(10);
        return view('adminmodule::towns', compact('get_all_towns'));
    }
     /** 
     * This function gets all districts of operarations
    */
    protected function viewClientsInThisTowns($town_id){
        $view_clients_towns =DB::table('clients')->join('towns','clients.town_id','towns.id')
        ->select('clients.*')
        ->where('town_id',$town_id)
        ->simplePaginate(10);
        return view('adminmodule::town_clients', compact('view_clients_towns'));
    }
    /** 
     * This function gets more information about client for admin
    */
    protected function moreOnClient($client_id){
        $get_client_information =DB::table('clients')->join('users','clients.user_id','users.id')
        ->join('regions','clients.region_id','regions.id')
        ->join('towns','clients.town_id','towns.id')
        ->join('fuel_stations','clients.fuel_station_id','fuel_stations.id')
        ->where('clients.deleted_at',null)
        ->where('client.id',$client_id)
        ->select('clients.*','regions.region','towns.town')->get();
        return view('adminmodule::more_on_clients', compact('get_client_information'));
    }
    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    protected function todaysDebts()
    {
        $get_all_todays_debts=DB::table('fuel_stations')->join('clients','fuel_stations.client_id','clients.id')
        ->join('users','fuel_stations.user_id','users.id')
        ->where('fuel_stations.status','pending')
        ->where('fuel_stations.created_at','>=',Carbon::today())
        ->select('clients.*','users.name','fuel_stations.*')->simplePaginate(10);
        return view('adminmodule::todays_debts',compact('get_all_todays_debts'));
    }
    protected function todaysPayments()
    {
        $get_all_todays_payments=DB::table('fuel_stations')->join('clients','fuel_stations.client_id','clients.id')
        ->join('users','fuel_stations.user_id','users.id')
        ->where('fuel_stations.status','paid')
        ->where('fuel_stations.created_at','>=',Carbon::today())
        ->select('clients.*','users.name','fuel_stations.*')->simplePaginate(10);
        return view('adminmodule::todays_payments',compact('get_all_todays_payments'));
    }
    protected function allTransactions()
    {
        $all_transactions=DB::table('fuel_stations')->join('clients','fuel_stations.client_id','clients.id')
        ->join('users','fuel_stations.user_id','users.id')
        ->where('fuel_stations.status','paid')
        ->orwhere('fuel_stations.status','pending')
        ->select('clients.*','users.name','fuel_stations.*')->simplePaginate(10);
        return view('adminmodule::all_transactions',compact('all_transactions'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('adminmodule::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('adminmodule::edit');
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

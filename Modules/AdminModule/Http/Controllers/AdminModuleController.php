<?php

namespace Modules\AdminModule\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AdminModule\Entities\InitialFloat;
use Modules\ClientModule\Entities\Client;
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
        $get_all_clients =DB::table('clients')->join('users','clients.user_id','users.id')
        ->join('regions','clients.region_id','regions.id')
        ->join('towns','clients.town_id','towns.id')
        ->where('clients.deleted_at',null)
        ->select('clients.*','regions.region','towns.town')
        ->simplePaginate(10);
        return view('adminmodule::index',compact('get_all_clients'));
    }
    /** 
    * This function gets clients registration form
    */
    protected function getRidersRegistrationForm(){
    $get_region =DB::table('regions')->get();
    $get_towns =DB::table('towns')->get();
    return view('adminmodule::riders_registration_form', compact('get_region','get_towns'));
    }
    /** 
     * This function views more on particular client
    */
    protected function todaysClients(){
        $get_todays_riders =DB::table('clients')->join('users','clients.user_id','users.id')
        ->join('regions','clients.region_id','regions.id')
        ->where('clients.deleted_at',null)
        ->where('clients.created_at','>=',Carbon::today())
        ->select('clients.*','regions.region')
        ->simplePaginate(10);
        return view('adminmodule::today_clients', compact('get_todays_riders'));
    }
    /** 
     * This function gets all the trashed clients
    */
    public function showTrash()
    {
        $trashed_client = Client::join('users','clients.user_id','users.id')
        ->join('regions','clients.region_id','regions.id')
        ->select('clients.*','regions.region')
        ->onlyTrashed()->simplePaginate('10');
        return view('adminmodule::trashed_client', compact('trashed_client'));
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
        ->select('users.name','initial_floats.*')
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
        $count_clients_per_town =DB::table('clients')->where('town_id',$town_id)->count();
        return view('adminmodule::town_clients', compact('view_clients_towns','count_clients_per_town'));
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
        ->select('clients.*','users.name','fuel_stations.*')->simplePaginate(10);
        return view('adminmodule::todays_debts',compact('get_all_todays_debts','total_debt_today'));
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
        ->where('fuel_stations.created_at','>=',Carbon::today())
        ->select('clients.*','users.name','fuel_stations.*')->simplePaginate(10);
        return view('adminmodule::todays_payments',compact('get_all_todays_payments','todays_payment'));
    }
    /** 
     * This function gets all debts
    */
    protected function allDebts()
    {
        $charge = \DB::table('charges')->where('status','pending')->sum('charge');
        $debts = \DB::table('fuel_stations')->where('status','pending')->sum('debt');
        $total_debt = $charge + $debts;

        $all_debts=DB::table('fuel_stations')->join('clients','fuel_stations.client_id','clients.id')
        ->join('users','fuel_stations.user_id','users.id')
        ->where('fuel_stations.status','pending')
        ->select('clients.*','users.name','fuel_stations.*')->simplePaginate(10);
        return view('adminmodule::all_debts',compact('all_debts','total_debt'));
    }

    /**
     * This function gets all payments.
     */
    protected function allPayments()
    {
        $payment = \DB::table('fuel_stations')->where('status','paid')->sum('amount_paid');

        $all_todays_payments=DB::table('fuel_stations')->join('clients','fuel_stations.client_id','clients.id')
        ->join('users','fuel_stations.user_id','users.id')
        ->whereNotNull('fuel_stations.amount_paid')
        ->where('fuel_stations.status','paid')
        ->select('clients.*','users.name','fuel_stations.*')->simplePaginate(10);
        return view('adminmodule::all_payments',compact('all_todays_payments','payment'));
    }

    /**
     * This function gets todays revenue
     */
    public function todayRevenue()
    {
        $get_todays_revenue =DB::table('charges')
        ->join('users','users.id','charges.fuel_station_id')
        ->join('clients','clients.id','charges.client_id')
        ->select('charges.*','clients.first_name','clients.other_names','clients.telephone','clients.number_plate')
        ->simplePaginate(10);
        //get sum of money collected today
        $amount_paid_today= DB::table('charges')->where('created_at','>=',Carbon::today())->sum('charge');
        return view('adminmodule::todays_revenue', compact('get_todays_revenue','amount_paid_today'));
    }
    /** 
     * This function gets all revenue
    */
    protected function getRevenue(){
    $get_all_client_payments =DB::table('charges')
    ->join('clients','charges.client_id','clients.id')
    ->where('charges.status','paid')
    ->select('clients.*','charges.charge','charges.created_at')
    ->simplePaginate(10);
    //get sum of money collected
    $get_total_revenue_collected= DB::table('charges')->where('status','paid')->sum('charge');
    return view('adminmodule::revenue',compact('get_all_client_payments','get_total_revenue_collected'));
    }

    /** 
    * This function gets all clients with pending debts
    */
    protected function getPendingClients(){
    $total_debt = \DB::table('charges')->where('status','pending')->sum('charge');
    $get_all_client_with_pending_payments=DB::table('charges')
        ->join('clients','charges.client_id','clients.id')
        ->where('charges.status','pending')
        ->select('clients.*','charges.charge','charges.created_at','charges.status')
       ->simplePaginate(10);
    return view('adminmodule::pending_debts',compact('get_all_client_with_pending_payments','total_debt')); 
    }

    /** 
    * This function gets all clients with overdue debts
    */
    protected function getOverdueClients(){

    $get_all_client_with_overdue_payments =DB::table('fuel_stations')->join('users','fuel_stations.user_id','users.id')
    ->join('clients','fuel_stations.client_id','clients.id')
    ->whereNotNull('fuel_stations.debt')
    ->where('fuel_stations.status','pending')
    ->where('fuel_stations.created_at', '<', Carbon::now()->subDays(30))
    ->select('clients.*','fuel_stations.debt','users.name','fuel_stations.created_at')
    ->simplePaginate(10);
    return view('adminmodule::overdue',compact('get_all_client_with_overdue_payments'));
    }
    /** 
    * This function gets all fuel stations in different towns
    */
    protected function getFuelStationsRevenue(){

    $get_fuel_stations =DB::table('users')->join('towns','users.town_id','towns.id')
    ->where('users.category','fuel_station')
    ->select('users.*','towns.town')
    ->simplePaginate(10);
    return view('adminmodule::towns_with_revenue',compact('get_fuel_stations'));
    }
    /** 
     * This function gets revenue summary per town per petro station
     */
    protected function revenueCalculationsPerTown($fuel_station_id){
    $charge = \DB::table('charges')->where('fuel_station_id',$fuel_station_id)->where('status','pending')->sum('charge');
    $total_amount_paid =DB::table('charges')->where('fuel_station_id',$fuel_station_id)->where('status','paid')->sum('charge');
    return view('adminmodule::town_revenue',compact('charge','total_amount_paid'));
    }
}

<?php

namespace Modules\FuelStation\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ClientModule\Entities\Client;
use Modules\FuelStation\Entities\FuelStation;
use Modules\FuelStation\Entities\Charge;
use Modules\AdminModule\Entities\InitialFloat;
use Auth;
use Carbon\Carbon;
use DB;

class FuelStationController extends Controller
{
    /**
     * This function gets search for clients.
     * @return Renderable
     */
    protected function index()
    {
        return view('fuelstation::search_form');
    }
    /** 
     * This function searches client.
     * Search by number plate
    */
    protected function searchClient(){
        $number_plate = str_replace('-',' ',request()->number_plate);
        if(Client::where('number_plate', $number_plate)->doesntExist())
        {
            return Redirect()->back()->withInput()->withErrors('Number Plate doesnot exists, please check your spelling or it is not Registered');
        }

        $amount_paid =FuelStation::where('fuel_stations.user_id',auth()->user()->id)->where('status','paid')->sum('amount_paid');

        $client_id = \DB::table('clients')->where('number_plate',$number_plate)->value('id');
        $charge = \DB::table('charges')->where('client_id',$client_id)->where('fuel_station_id',auth()->user()->id)->where('status','pending')->value('charge');
        
        if(\DB::table('clients')->where('id',$client_id)->where('is_chairman',0)->exists()){
            $debt_to_pay = $charge - \DB::table('fuel_stations')->where('client_id',$client_id)->where('status','pending')->sum('amount_paid');
        }else{
            $debt_to_pay = 0;
        }
        $debt = \DB::table('fuel_stations')->where('client_id',$client_id)->where('status','pending')->sum('debt') + $debt_to_pay;

        $get_client_information = Client::join('regions','clients.region_id','regions.id')
            ->join('towns','clients.town_id','towns.id')->Where('number_plate', 'like', '%'. $number_plate. '%')
            ->select('clients.*','regions.region','towns.town')->get();
        return view('fuelstation::client',compact('get_client_information','debt','amount_paid'));
    }
    /** 
     * This function gets All Clients details
    */
    protected function getClient(){
        $get_client_information =DB::table('clients')->join('users','clients.user_id','users.id')
        ->join('regions','clients.region_id','regions.id')
        ->join('towns','clients.town_id','towns.id')
        ->join('fuel_stations','clients.fuel_station_id','fuel_stations.id')
        ->where('clients.deleted_at',null)
        ->where('clients.number_plate','number_plate')
        ->select('clients.*','regions.region','towns.town')->get();
        
        return view('fuelstation::client',compact('get_client_information'));
    }
     /** 
     * This function gets form for fueling client
    */
    protected function clearClientDebtForm($client_id){
        return view('fuelstation::pay_debt_form');
    }
    /**
     * This function clears debt if the client has debt.
     */
    protected function payDebt($client_id)
    {
         //This saves to the fuel station
        $save_to_fuel_station =new FuelStation;
        $save_to_fuel_station->amount_paid =request()->amount_paid;
        $save_to_fuel_station->user_id =Auth::user()->id;
        $save_to_fuel_station->status  ='paid';
        $save_to_fuel_station->client_id =request()->client_id;
        $save_to_fuel_station->save();

        //This function clears the charge of thie client
        charge::where('client_id',$client_id)->latest()->update(array(
            'status' =>'paid'));

         //This function updates the client debt to 0
         FuelStation::where('client_id',$client_id)->latest('debt')->update(array(
            'status' =>'paid'
         ));
         $number_plate = DB::table('clients')->where('id',$client_id)->value('number_plate');
        return redirect()->to('/fuelstation/search-client-info?number_plate='.$number_plate)->with('msg', 'Operation Successfull');
    }
    /** 
     * This function gets form for fueling client
    */
    protected function fuelClientForm($client_id){
        if(FuelStation::where('status','pending')->where('client_id',$client_id)->exists())
        {
        return redirect()->back()->withErrors('This client has unpaid Debt,Please let him clear debt first before Fueling Again');
        }else{
        return view('fuelstation::give_fuel_form');
        }
    }
    /**
     * This function saves the amount of money for a client who has fueled.
     */
    public function fuelClient($client_id)
    {

        if(request()->debt < 5000 || request()->debt > 10000){
            return redirect()->back()->withErrors('The amount entered should be between 5000 to 10000');
        }

        if(Client::where('pin', request()->pin)->where('id',$client_id)->exists())
        {
            $now = Carbon::now();
            $days_from_now = $now->addDays(30);
          //This saves to the fuel station
            $save_to_fuel_station =new FuelStation;
            $save_to_fuel_station->debt =request()->debt;
            $save_to_fuel_station->pin =request()->pin;
            $save_to_fuel_station ->days=$days_from_now;
            $save_to_fuel_station->user_id =Auth::user()->id;
            $save_to_fuel_station->client_id =request()->client_id;
            $save_to_fuel_station->save();
            
           //This saves to charges
            $current_debt = request()->debt;
            if(Client::where('id',request()->client_id)->where('is_chairman',1)->exists()){
                $charge =$current_debt;
            }else{
                $charge = $current_debt * 0.1;
            }
            $save_charge =new Charge;
            $save_charge->charge   =$charge;
            $save_charge ->days=$days_from_now;
            $save_charge->client_id =request()->client_id;
            $save_charge->fuel_station_id =Auth::user()->id;
            $save_charge->save();

            $number_plate = DB::table('clients')->where('id',$client_id)->value('number_plate');
            return redirect()->to('/fuelstation/search-client-info?number_plate='.$number_plate)->with('msg', 'Operation Successfull');
        }else{
            return redirect()->back()->withErrors('This Pin does not match our details try again');
        }

    }

    /**
     * This function shows debts for particular fuel station.
     * get only debts
     */
    public function showFuelDebts()
    {
        $get_fuel_station_debts =FuelStation::join('clients','fuel_stations.client_id','clients.id')
        ->where('fuel_stations.user_id',auth()->user()->id)->simplePaginate(10);
        return view('fuelstation::fuel_station_debts');
    }
    /**
     * This function shows amount paid for particular fuel station.
     * get onlt amount paid
     */
    public function showFuelAmountPaid()
    {
        $get_fuel_station_debts =FuelStation::join('clients','fuel_stations.client_id','clients.id')
        ->where('fuel_stations.user_id',auth()->user()->id)->simplePaginate(10);
        return view('fuelstation::fuel_station_debts');
    }

    /** 
     * This function gets all initial deposits per station
    */
    protected function initialDeposits(){
        $get_all_initial_deposits_per_station =InitialFloat::join('users','initial_floats.fuel_station_id','users.id')
        ->where('initial_floats.fuel_station_id',auth()->user()->id)
        ->simplePaginate(10);
        return view('fuelstation::initial_deposit', compact('get_all_initial_deposits_per_station'));
    }

    public function RegisteredFuelStatinClients()
    {
        $get_all_clients =DB::table('clients')->join('users','clients.user_id','users.id')
        ->join('regions','clients.region_id','regions.id')
        ->join('towns','clients.town_id','towns.id')
        ->where('clients.deleted_at',null)
        ->where('clients.user_id',auth()->user()->id)
        ->select('clients.*','regions.region','towns.town')
        ->simplePaginate(10);
        return view('fuelstation::fuel_registered_clients',compact('get_all_clients'));
    }
}

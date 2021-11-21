<?php

namespace Modules\ClientModule\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ClientModule\Http\Requests\ClientFormRequest;
use Modules\ClientModule\Http\Requests\UserFormRequest;
use Modules\ClientModule\Entities\Client;
use Modules\ClientModule\Entities\Region;
use Modules\TransactionModule\Entities\Payment;
use DB;
use Auth;
use Carbon\Carbon;

class ClientModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     * This function gets all the registered clients
     * @return Renderable
     */
    protected function index()
    {
        $get_all_riders =DB::table('clients')->join('users','clients.user_id','users.id')
        ->join('regions','clients.region_id','regions.id')
        ->join('towns','clients.town_id','towns.id')
        ->where('clients.deleted_at',null)
        ->where('clients.user_id',auth()->user()->id)
        ->select('clients.*','regions.region','towns.town')
        ->simplePaginate(10);
        return view('clientmodule::index',compact('get_all_riders'));
    }
    /** 
     * This function views more on particular client
    */
    protected function todaysClients(){
        $get_todays_riders =DB::table('clients')->join('users','clients.user_id','users.id')
        ->join('regions','clients.region_id','regions.id')
        ->where('clients.deleted_at',null)
        ->where('clients.user_id',auth()->user()->id)
        ->where('clients.created_at','>=',Carbon::today())
        ->select('clients.*','regions.region')
        ->simplePaginate(10);
        return view('clientmodule::today_clients', compact('get_todays_riders'));
    }
    protected function viewMoreOnClient($client_id){
        $view_more_info =DB::table('clients')->join('users','clients.user_id','users.id')
        ->join('regions','clients.region_id','regions.id')
        ->join('towns','clients.town_id','towns.id')
        ->where('clients.id',$client_id)
        ->select('clients.*','regions.region','towns.town')
        ->get();
        $total_of_client_payments =Payment::where('client_id',$client_id)->groupBy('client_id')->sum('amount_paid');
        return view('clientmodule::view_more', compact('view_more_info','total_of_client_payments'));
    }
    /**
     * This function gets clients registered todday
     */
   /** 
    * This function gets clients registration form
   */
  protected function getRidersRegistrationForm(){
      $get_region =DB::table('regions')->get();
      $get_towns =DB::table('towns')->get();
      return view('clientmodule::riders_registration_form', compact('get_region','get_towns'));
  }
   /** 
     * This function creates clients information
    */
    private function createClientsInformation(){
        
        $client_photo = request()->profile_photo_path;
        $client_photo_original_name = $client_photo->getClientOriginalName();
        $client_photo->move('client_photos/',$client_photo_original_name);

        $client_obj =new Client;
        $client_obj ->first_name              =request()->first_name;
        $client_obj ->other_names             =request()->other_names;
        $client_obj ->town_id                 =request()->town_id;
        $client_obj ->region_id               =request()->region_id;
        $client_obj ->date_of_birth           =request()->date_of_birth;
        $client_obj ->telephone               =request()->telephone;
        $client_obj ->number_plate            =request()->number_plate;
        $client_obj ->id_number               =request()->id_number;
        $client_obj ->stage_name              =request()->stage_leader;
        $client_obj ->stage_leader            =request()->region_id;
        $client_obj ->stage_leader_contact    =request()->stage_leader_contact;
        $client_obj ->debt                    =request()->debt;
        $client_obj ->leader                  =request()->leader;
        $client_obj ->profile_photo_path      =$client_photo_original_name;
        $client_obj ->user_id                 =Auth::user()->id;
        $client_obj ->save();
        
        //$this->createPropertyOwnerAccount();
        return redirect()->back()->with('msg','operation successful');
    }
    /**
     * This function creates new rider in a particular stage
     */
    protected function createNewRider()
    {
        if(Client::where('telephone',request()->telephone)->exists()){
            return redirect()->back()->withErrors('This phone Number is already taken');
        }elseif(Client::where('number_plate',request()->number_plate)->exists()){
            return redirect()->back()->withErrors('This Number Plate is already taken');
        }elseif(Client::where('id_number',request()->id_number)->exists()){
            return redirect()->back()->withErrors('This ID Number is already taken');
        }else{
            return $this->createClientsInformation();
        }
        //return to the previous route
        return redirect()->back()->with('msg','operation successful');
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
     * Show the deleted clients from clients.
     * @param int $id
     * @return Renderable
     */
    public function showTrash()
    {
        $trashed_client = Client::join('users','clients.user_id','users.id')
        ->join('regions','clients.region_id','regions.id')
        ->where('clients.user_id',auth()->user()->id)
        ->select('clients.*','regions.region')
        ->onlyTrashed()->simplePaginate('10');
        return view('clientmodule::trashed_client', compact('trashed_client'));
    }

    /**
     * Show the form for editing the specified rider.
     * @param int $id
     * @return Renderable
     */
    protected function editRiderInfo($client_id)
    {
        $edit_rider_info =Client::join('regions','clients.region_id','regions.id')
        ->join('towns','clients.town_id','towns.id')
        ->where('clients.id',$client_id)->get();
        return view('clientmodule::edit_rider', compact('edit_rider_info'));
    }

    /**
     * Update the specified client.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    protected function update($client_id, ClientFormRequest $request)
    {
        Client::where('id',$client_id)->update($request->validated());
        //return to the previous route
        return redirect()->back()->with('msg','operation successful');
    }
    /** 
     * This function sift deletes data from clients
    */
    protected function softDeleteClient($client_id){
        Client::where('id',$client_id)->delete();
        //return to the previous route
        return redirect()->back()->with('msg','operation successful');
    }
    /**
     * this function restores the info of a deleted client
     */
    protected function restoreDeletedClient($client_id){
        Client::where('id',$client_id)->restore();
        return redirect()->back()->with('msg','Operation successful');
        //return to the previous route
    }
      /**
     * this function deletes the domestic worker from trash
     */
    protected function parmanetlyDeleteClient($client_id ){
        Client::where('id',$client_id)->forceDelete();
        //return to previous route
        return redirect()->back()->with('msg','Operation successful');
    }
     /**
     * Show the form for editing the specified rider.
     * @param int $id
     * @return Renderable
     */
    protected function payDebtForm($client_id)
    {
        $pay_debt =Client::where('id',$client_id)->get();
        return view('clientmodule::payment_form', compact('pay_debt'));
    }

    /**
     * Update the specified client Debt Payment.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    protected function updateDebtPayment($client_id, ClientFormRequest $request)
    {
        Client::where('id',$client_id)->update($request->validated());
        //return to the previous route
        return redirect()->back()->with('msg','operation successful');
    }
}

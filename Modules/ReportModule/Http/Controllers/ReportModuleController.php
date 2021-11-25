<?php

namespace Modules\ReportModule\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use DB;
use Carbon\Carbon;
use Modules\TransactionModule\Entities\Payment;
use Modules\ClientModule\Entities\Client;

class ReportModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $get_todays_revenue =DB::table('payments')->join('users','payments.user_id','users.id')
        ->join('clients','payments.client_id','clients.id')
        ->where('payments.deleted_at',null)
        ->where('payments.created_at','>=',Carbon::today())
        ->whereNotnull('payments.amount_paid')
        ->where('payments.user_id',auth()->user()->id)
        ->select('clients.*','payments.amount_paid')
        ->simplePaginate(10);
        //get sum of money collected today
        $amount_paid_today= DB::table('payments')->where('deleted_at',null)
        ->where('created_at','>=',Carbon::today())->sum('amount_paid');
        return view('reportmodule::index', compact('get_todays_revenue','amount_paid_today'));
    }

   /** 
    * This function gets all revenue
    *search using data range
   */
  protected function getRevenue(){
    $get_all_client_payments =DB::table('payments')->join('users','payments.user_id','users.id')
    ->join('clients','payments.client_id','clients.id')
    ->where('payments.deleted_at',null)
    ->whereNotnull('payments.amount_paid')
    ->where('payments.user_id',auth()->user()->id)
    ->select('clients.*','payments.amount_paid')
    ->simplePaginate(10);
    return view('reportmodule::revenue',compact('get_all_client_payments'));
  }
   /** 
    * This function gets all clients with pending debts
   */
  protected function getPendingClients(){
    $get_all_client_with_pending_payments =DB::table('clients')->join('users','clients.user_id','users.id')
    ->join('regions','clients.region_id','regions.id')
    ->where('clients.deleted_at',null)
    ->where('clients.status','pending')
    ->where('clients.user_id',auth()->user()->id)
    ->select('clients.*','regions.region')
    ->simplePaginate(10);
    return view('reportmodule::pending_debts',compact('get_all_client_with_pending_payments')); 
  }
  /** 
    * This function gets all clients with overdue debts
   */
  protected function getOverdueClients(){
    $get_all_client_with_overdue_payments =DB::table('clients')->join('users','clients.user_id','users.id')
    ->join('regions','clients.region_id','regions.id')
    ->where('clients.deleted_at',null)
    ->where('clients.status','overdue')
    ->where('clients.user_id',auth()->user()->id)
    ->select('clients.*','regions.region')->simplePaginate(10);
    return view('reportmodule::overdue_debts',compact('get_all_client_with_overdue_payments'));
  }
   /** 
    * This function gets all clients with overdue debts
   */
  protected function getClearedClients(){
    $get_all_client_with_cleared_debts =DB::table('clients')->join('users','clients.user_id','users.id')
    ->join('regions','clients.region_id','regions.id')
    ->where('clients.deleted_at',null)
    ->where('clients.status','cleared')
    ->where('clients.user_id',auth()->user()->id)
    ->select('clients.*','regions.region')->simplePaginate(10);
    return view('reportmodule::cleared_debts',compact('get_all_client_with_cleared_debts'));
  }
  /** 
   * This function gets clients who are field staff
  */
  protected function getFieldStaff(){
    $get_field_staff =DB::table('clients')->join('users','clients.user_id','users.id')
    ->join('regions','clients.region_id','regions.id')
    ->where('clients.leader','leader')->simplePaginate(10);
    return view('reportmodule::field_staff',compact('get_field_staff')); 
  }
   /** 
     * This function searches for client to pay debt
    */
    protected function searchTodaysRevenue(){
      if(Payment::join('users','payments.user_id','users.id')
      ->join('clients','payments.client_id','clients.id')
      ->select('clients.*','payments.amount_paid')
      ->where('number_plate', request()->number_plate)->doesntExist())
      {
          return Redirect()->back()->withInput()->withErrors('Number Plate doesnot exists, please check your spelling or it is not Registered');
      }
      $get_todays_revenue = Payment::join('users','payments.user_id','users.id')
      ->join('clients','payments.client_id','clients.id')
      ->select('clients.*','payments.amount_paid')->Where('number_plate', 'like', '%'. request()->number_plate. '%')
      ->simplePaginate('10');
  
      return view('reportmodule::index',compact('get_todays_revenue'));
  }
  /** 
     * This function searches for client to pay debt
    */
    protected function SearchAllRevenue(){

      if(Payment::join('users','payments.user_id','users.id')
      ->join('clients','payments.client_id','clients.id')
      ->select('clients.*','payments.amount_paid')
      ->where('number_plate', request()->number_plate)->doesntExist())
      {
          return Redirect()->back()->withInput()->withErrors('Number Plate doesnot exists, please check your spelling or it is not Registered');
      }
      $get_all_client_payments = Payment::join('users','payments.user_id','users.id')
      ->join('clients','payments.client_id','clients.id')
      ->select('clients.*','payments.amount_paid')->Where('number_plate', 'like', '%'. request()->number_plate. '%')
      ->simplePaginate('10');
  
      return view('reportmodule::revenue',compact('get_all_client_payments'));
  }
  /*
  * This function searches for client with pending debts
  */
  protected function searchPendingClient(){

      if(Client::where('number_plate', request()->number_plate)->doesntExist())
      {
          return Redirect()->back()->withInput()->withErrors('Number Plate doesnot exists, please check your spelling or it is not Registered');
      }
      $get_all_client_with_pending_payments = Client::Where('number_plate', 'like', '%'. request()->number_plate. '%')
      ->simplePaginate('10');
  
      return view('reportmodule::pending_debts',compact('get_all_client_with_pending_payments'));
  }
   /*
  * This function searches for client with overdue debts
  */
  protected function searchOverdueClient(){

    if(Client::where('number_plate', request()->number_plate)->doesntExist())
    {
        return Redirect()->back()->withInput()->withErrors('Number Plate doesnot exists, please check your spelling or it is not Registered');
    }
    $get_all_client_with_overdue_payments = Client::Where('number_plate', 'like', '%'. request()->number_plate. '%')
    ->simplePaginate('10');

    return view('reportmodule::overdue_debts',compact('get_all_client_with_overdue_payments'));
}
}

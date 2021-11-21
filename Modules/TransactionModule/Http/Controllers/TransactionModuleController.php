<?php

namespace Modules\TransactionModule\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\TransactionModule\Http\Requests\TransactionFormRequest;
use Modules\TransactionModule\Entities\Payment;
use Modules\ClientModule\Entities\Client;
use DB;
use Carbon\Carbon;
use Auth;

class TransactionModuleController extends Controller
{
    /**
     * Display todays transaction.
     * @return Renderable
     */
    public function index()
    {
        $get_all_todays_transaction =DB::table('payments')->join('users','payments.user_id','users.id')
        ->join('clients','payments.client_id','clients.id')
        ->where('clients.deleted_at',null)
        ->where('clients.status','pending')
        ->where('clients.user_id',auth()->user()->id)
        ->where('payments.created_at','>=',Carbon::today())
        ->select('clients.*','payments.amount_paid','payments.created_at')
        ->simplePaginate(10);
        return view('transactionmodule::index', compact('get_all_todays_transaction'));
    }
    /** 
     * This function shows all clients with pending debts 
    */
    protected function getClients(){
        $get_clients =DB::table('clients')->join('users','clients.user_id','users.id')
        ->join('regions','clients.region_id','regions.id')
        ->where('clients.deleted_at',null)
        ->where('clients.status','pending')
        ->where('clients.user_id',auth()->user()->id)
        ->select('clients.*','regions.region')
        ->simplePaginate(10);
        return view('transactionmodule::clients', compact('get_clients'));
    }
    protected function payDebtForm($client_id)
    {
        
        $pay_debt =DB::table('clients')->where('id',$client_id)->get();
        return view('transactionmodule::payment_form', compact('pay_debt'));
    }
    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function payDebt()
    {
        $pay_debt =new Payment;
        $pay_debt->amount_paid =request()->amount_paid;
        $pay_debt->client_id   =request()->client_id;
        $pay_debt->user_id     =Auth::user()->id;
        $pay_debt->save();
        //Payment::create($request->validated());
        //return to the previous route
        return redirect()->back()->with('msg','operation successful');
    }
    /** 
     * This function gets all clients payment details
     * receipt can be printed
    */
    protected function getReceipt($client_id){
        $all_client_payments_details =Payment::join('clients','payments.client_id','clients.id')
        ->where('payments.client_id',$client_id)
        ->where('payments.created_at','>=',Carbon::today())
        ->select('clients.*','payments.amount_paid','payments.created_at','payments.id')->limit(1)->latest('payments.created_at')->get();
        $total_of_client_payments =Payment::where('client_id',$client_id)->groupBy('client_id')->sum('amount_paid');
        return view('transactionmodule::receipt', compact('all_client_payments_details','total_of_client_payments'));
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
        return view('transactionmodule::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('transactionmodule::edit');
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

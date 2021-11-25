<?php

namespace Modules\AdminModule\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use DB;

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
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('adminmodule::create');
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

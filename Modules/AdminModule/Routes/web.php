<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('adminmodule')->group(function() {
    Route::get('/', 'AdminModuleController@index');
    Route::get('/fuel-stations','AdminModuleController@getFuelStations')->name('Fuel Stations');
    Route::get('/delete/{user_id}','AdminModuleController@deleteFuelStation');
    Route::get('/get-towns','AdminModuleController@getTowns')->name('Towns');
    Route::get('/view/{town_id}','AdminModuleController@viewClientsInThisTowns')->name('Town Clients');
    Route::get('/view-more/{client_id}','AdminModuleController@moreOnClient')->name('Town Clients');
    Route::get('/deposit-money/{user_id}','AdminModuleController@depositFloatMoneyForm')->name('depositMoney To Fuel Station');
    Route::get('/deposit/{user_id}','AdminModuleController@depositMoney');
    Route::get('/initial-deposit','AdminModuleController@initialDeposits')->name('initial Deposits Per Station');
    Route::get('/get-todays-debt','AdminModuleController@todaysDebts')->name('Todays Debts');
    Route::get('/get-todays-payments','AdminModuleController@todaysPayments')->name('Todays Payments');
    Route::get('/all-transactons','AdminModuleController@allTransactions')->name('allTransactions');
    
});

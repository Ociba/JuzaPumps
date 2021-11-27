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

Route::prefix('fuelstation')->group(function() {
    Route::get('/', 'FuelStationController@index');
    Route::get('/search-client','FuelStationController@index')->name('Fuel Service');
    Route::get('/search-client-info','FuelStationController@searchClient')->name('Searched Client Information');
    Route::get('/get-client-info','FuelStationController@getClient');
    Route::get('/fuel-client/{client_id}','FuelStationController@fuelClientForm')->name('Fuel Client Bike');
    Route::get('/fuel-client-now/{client_id}','FuelStationController@fuelClient');
    Route::get('/clear-debt/{client_id}','FuelStationController@clearClientDebtForm')->name('Pay Debt');
    Route::get('/pay-debt/{client_id}','FuelStationController@payDebt');
    Route::get('/initial-deposit','FuelStationController@initialDeposits')->name('My Fuel Station Initial Deposit');

    Route::get('/get-todays-debt','TransactionController@todaysDebts')->name('Todays Debts');
    Route::get('/get-todays-payments','TransactionController@todaysPayments')->name('Todays Payments');
    Route::get('/all-debts','TransactionController@allDebts')->name('All Debts');
    Route::get('/all-payments','TransactionController@allPayments')->name('All Payments');
    Route::get('/clients','FuelStationController@RegisteredFuelStatinClients')->name('Clients Registered In This Fuel Station');

    Route::get('/todays-revenue', 'ReportController@todayRevenue')->name('Transaction Report Summary Today');
    Route::get('/all-revenue','ReportController@getRevenue')->name('All Revenue');
    Route::get('/pending-debts','ReportController@getPendingClients')->name('Pending Debts');
    Route::get('/overdue','ReportController@getOverdueClients')->name('Overdue Debts');
});

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
    Route::get('/', 'AdminModuleController@index')->name('All Clients');
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
    Route::get('/all-debts','AdminModuleController@allDebts')->name('All Debts');
    Route::get('/all-payments','AdminModuleController@allPayments')->name('All Payments');

    Route::get('/view-more/{client_id}','AdminModuleController@viewMoreOnClient')->name('More On Client');
    Route::get('/todays-registered-riders','AdminModuleController@todaysClients')->name('Todays Registered Riders');
    Route::get('/get-riders-reg-form','AdminModuleController@getRidersRegistrationForm')->name('Registration Form');
    Route::get('/trashed-riders','AdminModuleController@showTrash')->name('Trashed Riders');

    Route::get('/todays-revenue', 'AdminModuleController@todayRevenue')->name('Transaction Report Summary Today');
    Route::get('/all-revenue','AdminModuleController@getRevenue')->name('All Revenue');
    Route::get('/pending-debts','AdminModuleController@getPendingClients')->name('Pending Debts');
    Route::get('/overdue','AdminModuleController@getOverdueClients')->name('Overdue Debts');
    Route::get('/cleared-debts','AdminModuleController@getClearedClients')->name('Cleared Debts');
    Route::get('/field-staff','AdminModuleController@getFieldStaff')->name('Field Staff');
    Route::get('/get-towns-with-revenue','AdminModuleController@getFuelStationsRevenue')->name('Towns');
    Route::get('/view-town-revenue/{fuel_station_id}','AdminModuleController@revenueCalculationsPerTown')->name('Revenue Per Town');
    Route::get('/search-by-data-range','ReportController@searchByDate')->name('Revenue');

    Route::get('/specific-transaction','TransactionController@specificDate')->name('Specific Date Transaction');
    Route::get('/search-transaction','TransactionController@searchSpecificDate')->name('Searched Specific Date Transaction');
    Route::get('/date-range-transaction','TransactionController@dateRange')->name('Date Range Transaction');
    Route::get('/search-date-range-transaction','TransactionController@searchByDate')->name('Date Range Transaction');
    
    Route::get('/specific-report','ReportController@ReportSpecificDate')->name('Specific Date Report');
    Route::get('/search-report','ReportController@searchReportSpecificDate')->name('Searched Specific Date Report');
    Route::get('/date-range-report','ReportController@reportDateRange')->name('Date Range Report');
    Route::get('/search-date-range-report','ReportController@searchReportByDate')->name('Date Range Report');
});

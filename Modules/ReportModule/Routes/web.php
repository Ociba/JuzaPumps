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
Route::group(['prefix'=>'reportmodule', 'middleware'=>['auth']],function(){
    Route::get('/', 'ReportModuleController@index')->name('Transaction Report Summary Today');
    Route::get('/all-revenue','ReportModuleController@getRevenue')->name('All Revenue');
    Route::get('/pending-debts','ReportModuleController@getPendingClients')->name('Pending Debts');
    Route::get('/overdue','ReportModuleController@getOverdueClients')->name('Overdue Debts');
    Route::get('/cleared-debts','ReportModuleController@getClearedClients')->name('Cleared Debts');
    Route::get('/field-staff','ReportModuleController@getFieldStaff')->name('Field Staff');
    Route::get('/search-todays-revenue','ReportModuleController@searchTodaysRevenue')->name('Searched Client');
    Route::get('/search-all-revenue','ReportModuleController@SearchAllRevenue')->name('Searched Client');
    Route::get('/search-pending-debts','ReportModuleController@searchPendingClient')->name('Searched Client');
    Route::get('/search-overdue-debts','ReportModuleController@searchOverdueClient')->name('Searched Client');
    Route::get('/delete/{user_id}','ReportModuleController@deleteFieldStaff');
});

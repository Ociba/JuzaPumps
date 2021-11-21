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
Route::group(['prefix'=>'transactionmodule', 'middleware'=>['auth']],function(){
    Route::get('/todays-transaction', 'TransactionModuleController@index')->name('Todays Transaction');
    Route::get('/pay-debt','TransactionModuleController@getClients')->name('Clients To Pay Debt');
    Route::get('/pay-debt/{client_id}','TransactionModuleController@payDebtForm')->name('Pay Debt Form');
    Route::get('/save-payment/{client_id}','TransactionModuleController@payDebt');
    Route::get('/payment-details-receipt/{payment_id}','TransactionModuleController@getReceipt')->name('Payment Details');
});

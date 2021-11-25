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
Route::group(['prefix'=>'clientmodule', 'middleware'=>['auth']],function(){
    Route::get('/', 'ClientModuleController@index')->name('All Registered Riders');
    Route::get('/view-more/{client_id}','ClientModuleController@viewMoreOnClient')->name('More On Client');
    Route::get('/todays-registered-riders','ClientModuleController@todaysClients')->name('Todays Registered Riders');
    Route::get('/get-riders-reg-form','ClientModuleController@getRidersRegistrationForm')->name('Registration Form');
    Route::post('/save-rider','ClientModuleController@createNewRider');
    Route::get('/edit-riders-info/{client_id}','ClientModuleController@editRiderInfo')->name('Edit Riders Info');
    Route::get('/trashed-riders','ClientModuleController@showTrash')->name('Trashed Riders');
    Route::get('/restore/{client_id}','ClientModuleController@restoreDeletedClient');
    Route::get('/trash/{client_id}','ClientModuleController@softDeleteClient');
    Route::get('/remove-from-trash/{client_id}','ClientModuleController@parmanetlyDeleteClient');
    Route::get('/update-client-info/{client_id}','ClientModuleController@update');
    Route::get('/search-client','ClientModuleController@searchClient')->name('Searched Client');
    Route::get('/search-todays-client','ClientModuleController@searchTodaysClient')->name('Searched Client');
    Route::get('/search-trashed-client','ClientModuleController@searchTrashedClient')->name('Searched Client');
});

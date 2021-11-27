<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Livewire\ClientController;
use App\Http\Controllers\PermissionsController;

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

Route::get('/', function () {
    return view('auth.login');
})->name('Login');

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

Route::middleware(['auth'])->group( function(){
Route::get('/dashboard',[DashboardController::Class, 'getDashboard'])->name('Dashboard');
Route::get('/register', function (){return redirect('/login');});
Route::get('/logout',[AuthenticationController::Class, 'logoutUser']);
Route::get('/register-user',[AuthenticationController::Class,'registerUserForm'])->name('Register User');
Route::post('/save-user',[AuthenticationController::Class,'validateRegisterUser']);
Route::get('/registered-users',[AuthenticationController::Class,'getUser'])->name('Registered Users');
Route::get('/delete/{user_id}',[AuthenticationController::Class,'deleteUser']);

Route::get('/get-users',[PermissionsController::Class,'getUsersForPermissions'])->name('Users For Permissions');
Route::get('/user-and-permissions/{user_id}',[PermissionsController::Class,'getUserAndPermission'])->name('User Permissions');
Route::get('/delete-permission/{id}',[PermissionsController::Class,'removePermissionFromUser']);
Route::get('/get-permissions/{user_id}',[PermissionsController::Class,'getPermissions'])->name('Permissions');
Route::get('/assign-permissions/{user_id}',[PermissionsController::Class,'assignPermission']);
});
Route::get('/get-towns',[AuthenticationController::Class,'getAllTowns'])->name('Rgistered Towns');
Route::get('/registered-town',[AuthenticationController::Class,'registerTownForm'])->name('Rgister Town Now');
Route::get('/save-town',[AuthenticationController::Class,'registerTown']);
Route::get('/delete-town/{town_id}',[AuthenticationController::Class,'deleteTown']);

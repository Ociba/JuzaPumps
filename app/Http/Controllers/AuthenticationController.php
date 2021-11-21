<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Models\User;
use DB;

class AuthenticationController extends Controller
{
    /** 
     * This function logsout user and redirects to welcome page
    */
    protected function logoutUser(){
        Auth::logout();
        return redirect('/');
    }
    /** 
     * This function gets form to get form for registering users
    */
    protected function registerUserForm(){
        return view('admin.register_user');
    }
    /**
     * This function registers users
     * registers to user table
     */
    private function registerUser(){
        $user_photo = request()->profile_photo_path;
        $user_photo_original_name = $user_photo->getClientOriginalName();
        $user_photo->move('user_photos/',$user_photo_original_name);

        $user_obj = new User;
        $user_obj->email       = request()->email;
        $user_obj->name        = request()->name;
        $user_obj->profile_photo_path =$user_photo_original_name;
        $user_obj->password    = Hash::make(request()->password);
        $user_obj->save();
        return redirect()->back()->with('msg','Operation successful');
    }

     /** 
     * Ths function validates the property owner details
    */
    protected function validateRegisterUser(){
        if(empty(request()->name)){
            return redirect()->back()->withErrors('Enter name to continue');
        }elseif(empty(request()->email)){
            return redirect()->back()->withErrors('Enter Email to continue');
        }elseif(empty(request()->profile_photo_path)){
            return redirect()->back()->withErrors('Enter Photo to continue');
        }elseif(User::where('email',request()->email)->exists()){
            return redirect()->back()->withErrors('This email is already taken');
        }else{
            if(request()->password == request()->password_confirmation){
                return $this->registerUser();
            }else{
                return redirect()->back()->withErrors('Make sure the two passwords match');
            }
        }
    }
     /**
     * This function fetches all users
     */
    protected function getUser(){
        $get_users =DB::table('users')->simplePaginate(10);
        return view('admin.users', compact('get_users'));
    }
    /** 
     * This function deletes user Permanently
    */
    protected function deleteUser($user_id){
         User::where('id',$user_id)->delete();
         return redirect()->back()->with('msg','Operation successful');
    }
}

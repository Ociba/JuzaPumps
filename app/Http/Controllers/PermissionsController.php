<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\UserPermission;

class PermissionsController extends Controller
{
    /** 
     * This function gets users to give permissions
    */
    protected function getUsersForPermissions(){
        $get_users =DB::table('users')->simplePaginate(10);
        return view('permissions.users', compact('get_users'));
    }
      /** 
     * This function gets page for user and permissions assigned
    */
    protected function getUserAndPermission($user_id){
        //This gets the user selected for permissions
       $get_user_and_permissions =DB::table('users')->where('id',$user_id)->get();
       //This gets the permissions assigned for the user
       $get_permissions_for_this_user =DB::table('user_permissions')
       ->join('permissions','user_permissions.permission_id','permissions.id')
       ->select('permissions.permission','user_permissions.*')
       ->where('user_id',$user_id)->simplePaginate(10);
       return view('permissions.user_and_permissions', compact('get_user_and_permissions','get_permissions_for_this_user'));
    }
    /** 
     * This function unassigns the permission from user
    */
    protected function removePermissionFromUser($id){
        UserPermission::where('id',$id)->delete();
        return redirect()->back()->with('msg','Operation Successful');
    }
    /** 
     * This function gets permissions
    */
    protected function getPermissions($user_id){
        $get_users =DB::table('users')->where('id',$user_id)->get();
        $get_permission =DB::table('permissions')->simplePaginate(10);
        return view('permissions.permissions', compact('get_users','get_permission'));
    }
    /** 
     * This function assigns user selected permissions
    */ 
    protected function assignPermission($id, Request $request){
        if(empty($request->user_permisions)){
            return redirect()->back()->withErrors("No updates were made, you didn't select any permision");
        }
        $permissions = $request->user_permisions;
            foreach($permissions as $permission){
                if(UserPermission::where('user_id',$id)->where('permission_id',$permission)->exists()){
                    continue;
                }
                else{
                    UserPermission::create(array(
                        'user_id' => $id,
                        'permission_id' => $permission
                    ));
                }
            }
       return Redirect()->back()->with('msg',"Operation Successful");
    }
}

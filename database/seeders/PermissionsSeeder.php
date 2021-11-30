<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = ["Can Edit Client","Can Trash Client","Can Restore Client","Can Delete Client",
        "Can view admin sidebar",'Can View field staff sidebar','Can View fuel station sidebar',"Can Delete User","Can View Registered Users Option"];

        for($i=0; $i < count($permissions); $i++){
           $permission = new Permission();
            if(Permission::where("id",$i)->exists()){
                $permission->id = $i+1;
            }
            else{
               $permission->id = $i;
            } 
            $permission->Permission=$permissions[$i];
            $permission->save();
        }
    }
}
